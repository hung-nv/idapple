$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name="_token"]').attr('content') }
    });

    setTimeout(function() { $(".alert-info").hide(); }, 5000);

    if($('.apple-errors').length) {
        setTimeout(function() { $(".alert-danger").hide(); }, 5000);
    }

    $('#add-channel').on('submit', function (e) {
        var channel_url = $('#channel_url').val();
        var pattern = new RegExp('((http|https):\/\/|)(www\.|)youtube\.com\/(channel\/|user\/)[a-zA-Z0-9\-]{1,}');

        if(pattern.test(channel_url)) {
            var channelId = channel_url.split('/').pop();
            $.ajax({
                url : "https://www.googleapis.com/youtube/v3/channels",
                type : "get",
                async: false,
                data: {part: 'snippet,contentDetails,statistics', id: channelId, key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg'},
                success : function(result) {
                    $.each(result.items, function (i, item) {
                        var channel_logo = item.snippet.thumbnails.default.url;
                        $('#channel_logo').val(channel_logo);
                        $('#channel_id').val(channelId);
                    });
                },
                error: function() {
                }
            });
        }
    });

    if($('.page-analytics').length) {
        var channelId = $('#channel_id').val();

        $.ajax({
            url : "https://www.googleapis.com/youtube/v3/channels",
            type : "get",
            async: false,
            data: {part: 'contentDetails,statistics', id: channelId, key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg'},
            success: function (result) {
                $.each(result.items, function (i, item) {
                    var total_sub = item.statistics.subscriberCount;
                    var total_view = item.statistics.viewCount;
                    var total_video = item.statistics.videoCount;
                    $('.total_subscriber').html(numberWithCommas(total_sub));
                    $('.total_views').html(numberWithCommas(total_view));
                    $('.total_video').html(total_video);
                    var pid = item.contentDetails.relatedPlaylists.uploads;
                    getVids(pid)
                });
            }
        });

        function getVids(pid) {
            var nextPageToken = '';
            var output = '';
            while(nextPageToken != null) {
                $.ajax({
                    url : "https://www.googleapis.com/youtube/v3/playlistItems",
                    type : "get",
                    async: false,
                    data: {part: 'contentDetails', playlistId: pid, maxResults: 10, key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg', pageToken: nextPageToken},
                    success: function (result) {
                        $.each(result.items, function (i, item) {
                            var videoId = item.contentDetails.videoId;
                            output += getViewById(videoId);
                        });
                        nextPageToken = result.nextPageToken;
                    }
                });
            }

            $('.data-list-video').html(output);
        }

        function getViewById(videoId) {
            var title = '', view = 0, output = '';
            $.ajax({
                url : "https://www.googleapis.com/youtube/v3/videos",
                type : "get",
                async: false,
                data: {part: 'snippet,statistics', id: videoId, key: 'AIzaSyD7SZNCb6bGSFqb2teULEFt5thV4B22Upg'},
                success: function (result) {
                    title = result.items[0].snippet.title;
                    view = numberWithCommas(result.items[0].statistics.viewCount);
                }, complete: function () {
                    output = '<tr class="odd gradeX"><td>' + title + '</td><td>' + view + '</td></tr>';
                }
            });
            return output;
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }

    if($('.page-buyid').length) {
        $('#get-first-id').on('click', function () {
            var serverName = window.location.protocol + "//" + window.location.host;
            var domain = $('#domain').val();
            $.ajax({
                url: serverName + '/getfirstid',
                type: 'post',
                dataType: 'json',
                data: {domain: domain},
                async: false,
                success: function (data) {
                    if(data!== undefined && data.account !== undefined) {
                        $('#apple_id').val(data.account.apple_id);
                        $('#password').val(data.account.password);
                        $('#current-coint').html(data.current_coint);
                    }
                }, error: function(data){
                    var divError = $('.error-get-id');
                    divError.removeClass('hidden');
                    divError.addClass('alert-danger');
                    divError.html(data.responseJSON.message);
                }, complete: function () {
                    //reload select domain
                }
            });
        });
    }

    $('#copy-apple-id').on('click', function () {
        copyToClipboard(document.getElementById("apple_id"));
    });

    $('#copy-password').on('click', function () {
        copyToClipboard(document.getElementById("password"));
    });

    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }
});