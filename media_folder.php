<?php
/**
 * Plugin Name: WordPress Media Folder
 * Plugin URI: https://github.com/linroex/WordPress-Media-Folder
 * Description: 可以顯示你最近上傳的檔案、上傳時間，做出媒體櫃的概念，並指定要顯示的檔案格式
 * Version: 0.0.1
 * Author: linroex
 * Author URI: http://coder.tw
 * License: GPL2
 */

function get_medias($id){
    $result = [];
    $attachments = get_attached_media('', $id);
    foreach($attachments as $attachment){
        array_push($result, ['url'=>$attachment->guid, 'date'=>$attachment->post_date, 'title'=>$attachment->post_title]);
    }
    return $result;
}
function format($attachments_object){

    $html = '<table>';

    foreach ($attachments_object as $attachment) {
        $html .= '<tr>';
        $html .= '<td>' . $attachment['url'] . '</td>';
        $html .= '<td>' . $attachment['title'] . '</td>';
        $html .= '<td>' . $attachment['date'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';
    return $html;
}
function media_folder_shortcode(){
    return format(get_medias(get_the_ID()));
}
add_shortcode('mfolder','media_folder_shortcode');