<?php

if (!function_exists('setMultiMenu')) {

    /*
     * Get multi menu (3 floor)
     */

    function setMultiMenu($data) {
        $return = [];
        foreach ($data as $item) {
            $child = [];
            foreach ($data as $n => $i) {
                $grand = [];

                if ($i->parent_id == $item->id) {
                    unset($data[$n]);
                    foreach ($data as $m => $j) {
                        if ($j->parent_id == $i->id) {
                            $grand[] = $j;
                            unset($data[$m]);
                        }
                    }

                    if (isset($grand) && $grand) {
                        $i->grand = $grand;
                    }

                    $child[] = $i;
                }
            }

            if (empty($child) && $item->parent_id == 0) {
                $return[] = $item;
            } else if(!empty($child)) {
                $item->child = $child;
                $return[] = $item;
            }

        }
        return $return;
    }

    function get_youtube_channel_ID($url){
        $html = file_get_contents($url);
        preg_match("'<meta itemprop=\"channelId\" content=\"(.*?)\"'si", $html, $match);
        if($match && $match[1]);
        return $match[1];
    }
}

?>