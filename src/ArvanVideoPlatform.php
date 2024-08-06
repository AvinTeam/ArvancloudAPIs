<?php

namespace Avinmedia\ArvancloudApis;

use Avinmedia\ArvancloudApis\Http\GuzzleClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ArvanVideoPlatform
{
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }


    public function allUserChannels($filter = null, int $page = null, int $per_page = null)
    {
        return $this->client->get("channels", ["filter" => $filter, "page" => $page, "per_page" => $per_page]);
    }

    public function getChannelWithId(string $channelId)
    {
        return $this->client->get("channels/" . $channelId);
    }

    public function storeNewChannel(string $title, string $description = null, bool $secure_link_enabled = false, string $secure_link_key = null, bool $secure_link_with_ip = true, bool $ads_enabled = false, string $present_type = null, string $campaign_id = null)
    {
        return $this->client->post("channels", [
            "title" => $title,
            "description" => $description,
            "secure_link_enabled" => $secure_link_enabled,
            "secure_link_key" => $secure_link_key,
            "secure_link_with_ip" => $secure_link_with_ip,
            "ads_enabled" => $ads_enabled,
            "present_type" => $present_type,
            "campaign_id" => $campaign_id]);
    }

    public function deleteChannelWithId(string $channelId)
    {
        return $this->client->delete("channels/" . $channelId);
    }

    public function updateChannelWithId(string $channelId, string $title, string $description = null, bool $secure_link_enabled = false, string $secure_link_key = null, bool $secure_link_with_ip = true, bool $ads_enabled = false, string $present_type = null, string $campaign_id = null)
    {
        return $this->client->patch("channels/" . $channelId, [
            "title" => $title,
            "description" => $description,
            "secure_link_enabled" => $secure_link_enabled,
            "secure_link_key" => $secure_link_key,
            "secure_link_with_ip" => $secure_link_with_ip,
            "ads_enabled" => $ads_enabled,
            "present_type" => $present_type,
            "campaign_id" => $campaign_id]);
    }

    /**
     * @param string $channelId
     * @param string|null $filter
     * @param int|null $page
     * @param int|null $per_page
     * @param string|null $secure_ip
     * @param int|null $secure_expire_time
     * @param string|null $order_by
     * @param string|null $sort
     * @return array|mixed
     */
    public function allChannelVideos(string $channelId, string $filter = null, int $page = null, int $per_page = null, string $secure_ip = null, int $secure_expire_time = null, string $order_by = null, string $sort = null)
    {
        return $this->client->get("channels/$channelId/videos", ["filter" => $filter, "page" => $page, "per_page" => $per_page, "secure_expire_time" => $secure_expire_time, "order_by" => $order_by, "sort" => $sort]);
    }

    public function getVideoWithId(string $videoId)
    {
        return $this->client->get("videos/" . $videoId);
    }

    public function storeNewVideo(string $channelId, string $title, string $video_url, string $description = null, string $convert_mode = "auto")
    {
        return $this->client->post("channels/$channelId/videos", [
            "title" => $title,
            "video_url" => $video_url,
            "description" => $description,
            "convert_mode" => $convert_mode,
        ]);
    }

    public function deleteVideoWithId(string $videoId)
    {
        return $this->client->delete("videos/" . $videoId);
    }

    public function updateVideoWithId(string $videoId, string $title, string $description = null)
    {
        return $this->client->patch("videos/$videoId", [
            "title" => $title,
            "description" => $description,
        ]);
    }

}
