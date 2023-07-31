<?php

namespace Modules\Media\Traits;

use Optix\Media\HasMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Media\Entities\MediaUploader;
// use Optix\Media\MediaUploader;
use Optix\Media\Models\Media;

trait MediaVideoFields
{
    use HasMedia;

    /**
     * Get the thumbnail URL
     *
     * @param
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return $this->getImageURL('cover_images', 'thumb');
    }

    /**
     * Get the Image Field full URL
     *
     * @param
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->getImageURL('cover_images');
    }

    /**
     * Get the video Field full URL
     *
     * @param
     * @return string
     */
    public function getVideoUrlAttribute()
    {
        return $this->getVideoURL('videos');
    }

    /**
     * Get the video Field full URL
     *
     * @param
     * @return string
     */
    public function getVideoIdAttribute()
    {
        return $this->getVideoID('videos');
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  string  $imageGroup
     * @param  string  $imagePreset
     * @return string
     */
    public function getImageURL($imageGroup, $imagePreset=Null)
    {
        $preset = $imagePreset ? $imagePreset : '';
        $media = $this->getMedia($imageGroup)->values();
        $mediaCount = $media->count();

        if( $mediaCount > 0 ) {
            $imageUrl = $media[$mediaCount - 1]->getUrl($preset);
            return $imageUrl;
        }
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  string  $imageGroup
     * @param  string  $imagePreset
     * @return string
     */
    public function getVideoURL($imageGroup, $imagePreset=Null)
    {
        $media = $this->getMedia($imageGroup)->values();
        $mediaCount = $media->count();

        if( $mediaCount > 0 ) {
            $imageUrl = $media[$mediaCount - 1]->getUrl();
            return $imageUrl;
        }
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  string  $imageGroup
     * @param  string  $imagePreset
     * @return string
     */
    public function getVideoID($imageGroup, $imagePreset=Null)
    {
        $media = $this->getMedia($imageGroup)->values();
        $mediaCount = $media->count();

        if( $mediaCount > 0 ) {
            $id = $media[$mediaCount - 1]->id;
            return $id;
        }
    }

    public function uploadAndAttachCoverImage(Request $request) {

        $data = $request->all();

        // Upload image if available
        if (isset($data['image'])) {
            $uploadFolder = 'cover_images';
            $fileName = $data['image']->getClientOriginalName();
            $fileDescription = '';

            $media = MediaUploader::fromFile($data['image'])
                // ->useFileName('custom-file-name.jpeg')
                ->useUploadFolder($uploadFolder)
                ->useFileDescription($fileDescription)
                ->useUserId(Auth::user()->id)
                ->useName($fileName)
                ->upload();
            // To "images" group
            $this->attachMedia($media, 'cover_images');
        }

        // Attach existing image if provided
        if (isset($data['image_id'])) {
            $media = Media::findOrFail($data['image_id']);
            $this->attachMedia($media, 'cover_images');
        }

        return true;
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  object  $request
     * @param  array  $mediaInfo
     * @return string
     */
    public function uploadOrAttachVideo(Request $request, $mediaInfo = null) {

        $data = $request->all();

        if ($mediaInfo == null) {
            $mediaInfo['upload_field'] = 'video';
            $mediaInfo['attach_field'] = 'video_id';
            $mediaInfo['upload_group'] = 'videos';
        }

        $mediaFieldName = $mediaInfo['upload_field'] ;
        $mediaGroup = $mediaInfo['upload_group'];
        $mediaAttachFieldName = $mediaInfo['attach_field'];

        if (isset($data[$mediaFieldName])) {
            // $uploadFolder = $mediaGroup;
            $fileName = $data[$mediaFieldName]->getClientOriginalName();
            $fileDescription = '';

            $media = MediaUploader::fromFile($data[$mediaFieldName])
                // ->useFileName('custom-file-name.jpeg')
                ->useUploadFolder($mediaGroup)
                ->useFileDescription($fileDescription)
                ->useUserId(Auth::user()->id)
                ->useName($fileName)
                ->upload();

                $this->attachMedia($media, $mediaGroup);
        }

        // Attach existing image if provided
        if (isset($data[$mediaAttachFieldName])) {
            $media = Media::findOrFail($data[$mediaAttachFieldName]);
            $this->attachMedia($media, $mediaGroup);
        }

        // attach media_video
        if (isset($data['media_video_id'])) {
            $this->media_videos()->sync([$request['media_video_id']]);
        }
        // detach media_video
        if ($request->_detach_media_video) {
            $this->media_videos()->detach($request->_detach_media_video);
        }

        return true;
    }

}
