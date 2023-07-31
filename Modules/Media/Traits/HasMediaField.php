<?php

namespace Modules\Media\Traits;

use Optix\Media\HasMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Media\Entities\MediaUploader;
// use Optix\Media\MediaUploader;
use Optix\Media\Models\Media;

trait HasMediaField
{
    use HasMedia;

    /**
     * Get the attachments
     *
     * @param
     * @return string
     */
    public function getMediaImageAttribute()
    {
        return [
            'thumbnail' => $this->getImageURL('images', 'thumb'),
            'thumbnail-landscape' => $this->getImageURL('images', 'thumbnail-landscape'),
            'thumbnail-portrait' => $this->getImageURL('images', 'thumbnail-portrait'),
            'preview-sm' => $this->getImageURL('images', 'preview-sm'),
            'preview-lg' => $this->getImageURL('images', 'preview-lg'),
            'slider' => $this->getImageURL('images', 'slider'),
            'slider-md' => $this->getImageURL('images', 'slider-md'),
            'original' => $this->getImageURL('images'),
        ];
    }
    /**
     * Get the thumbnail URL
     *
     * @param
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return $this->getImageURL('images', 'thumb');
    }

    /**
     * Get the Image Field full URL
     *
     * @param
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->getImageURL('images');
    }

    /**
     * Get the Avatar Field thumbnail URL
     *
     * @param
     * @return string
     */
    public function getAvatarThumbnailAttribute()
    {
        return $this->getImageURL('avatars', 'thumb');
    }

    /**
     * Get the BgImage Field thumbnail URL
     *
     * @param
     * @return string
     */
    public function getBgThumbnailAttribute()
    {
        return $this->getImageURL('bg_images', 'thumb');
    }

    /**
     * Get the BgImage Field full URL
     *
     * @param
     * @return string
     */
    public function getBgImageAttribute()
    {
        return $this->getImageURL('bg_images');
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
     * Get the attachments
     *
     * @param
     * @return string
     */
    public function getMediaAttachmentsAttribute()
    {
        return $this->getMedia('attachments')->values();
    }

    public function uploadAndAttachImage(Request $request) {

        $data = $request->all();

        // Upload image if available
        if (isset($data['image'])) {
            $uploadFolder = 'images';
            $fileName = $data['image']->getClientOriginalName();
            $fileDescription = '';

            $fileCreatedAt = now();
            if (isset($request['fileCreatedAt'])) {
                $fileCreatedAt = $request['fileCreatedAt'];
            }

            $media = MediaUploader::fromFile($data['image'])
                ->useUploadFolder($uploadFolder)
                ->useFileDescription($fileDescription)
                ->useUserId(Auth::user() ? Auth::user()->id : 1)
                ->useName($fileName)
                ->useFileCreatedAt($fileCreatedAt)
                ->upload();
            // To "images" group
            $this->attachMedia($media, 'images');
        }

        // Attach existing image if provided
        if (isset($data['image_id'])) {
            $media = Media::findOrFail($data['image_id']);
            $this->attachMedia($media, 'images');
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
    public function uploadAndAttachBgImage(Request $request) {

        $data = $request->all();

        if (isset($data['bg_image'])) {
            $uploadFolder = 'bg_images';
            $fileName = $data['bg_image']->getClientOriginalName();
            $fileDescription = '';

            $fileCreatedAt = now();
            if (isset($request['fileCreatedAt'])) {
                $fileCreatedAt = $request['fileCreatedAt'];
            }

            $media = MediaUploader::fromFile($data['bg_image'])
                ->useUploadFolder($uploadFolder)
                ->useFileDescription($fileDescription)
                ->useUserId(Auth::user() ? Auth::user()->id : '')
                ->useName($fileName)
                ->useFileCreatedAt($fileCreatedAt)
                ->upload();
            // To "images" group
            $this->attachMedia($media, 'bg_images');
        }

        // Attach existing image if provided
        if (isset($data['bg_image_id'])) {
            $media = Media::findOrFail($data['bg_image_id']);
            $this->attachMedia($media, 'bg_images');
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
    public function uploadOrAttachMedia(Request $request, $mediaInfo = null) {

        $this->uploadOrAttachImage($request, $mediaInfo);
        $this->uploadOrAttachAttachments($request, $mediaInfo);
        $this->uploadOrAttachBgImage($request);

        // Attach media_video
        if ($request->media_video_id) {
            $this->media_videos()->sync([$request['media_video_id']]);
        }

        // Detach image
        if ($request->_detach_image) {
            $this->media('images')->detach($request->_detach_image);
        }
        // Detach bg_image
        if ($request->_detach_bg_image) {
            $this->media('bg_images')->detach($request->_detach_bg_image);
        }
        // Detach media_video
        if ($request->_detach_media_video) {
            $this->media_videos()->detach($request->_detach_media_video);
        }
        // Detach attachment
        if ($request->_detach_attachment) {
            $this->media('attachments')->detach($request->_detach_attachment);
        }

        return true;
    }

    /**
     * Upload or attach image
     *
     * @param  object  $request
     * @param  array  $mediaInfo
     * @return string
     */
    public function uploadOrAttachImage(Request $request, $mediaInfo = null) {
        //
        if ($mediaInfo == null) {
            $mediaInfo['upload_field'] = 'image';
            $mediaInfo['attach_field'] = 'image_id';
            $mediaInfo['upload_group'] = 'images';
        }
        $this->uploadOrAttach($request, $mediaInfo);

        return true;
    }

    /**
     * Upload or attach bg_image
     *
     * @param  object  $request
     * @param  array  $mediaInfo
     * @return string
     */
    public function uploadOrAttachBgImage(Request $request, $mediaInfo = null) {
        // 
        if ($mediaInfo == null) {
            $mediaInfo['upload_field'] = 'bg_image';
            $mediaInfo['attach_field'] = 'bg_image_id';
            $mediaInfo['upload_group'] = 'bg_images';
        }
        $this->uploadOrAttach($request, $mediaInfo);

        return true;
    }

    /**
     * Upload or attach attachments
     *
     * @param  object  $request
     * @param  array  $mediaInfo
     * @return string
     */
    public function uploadOrAttachAttachments(Request $request, $mediaInfo = null) {
        // 
        if ($mediaInfo == null) {
            $mediaInfo['upload_field'] = 'attachments';
            $mediaInfo['attach_field'] = 'attachments_ids';
            $mediaInfo['upload_group'] = 'attachments';
        }
        $this->uploadOrAttach($request, $mediaInfo);

        return true;
    }

    /**
     * upload or attach provided media
     *
     * @param  object  $request
     * @param  array  $mediaInfo
     * @return string
     */
    public function uploadOrAttach(Request $request, $mediaInfo = null) {

        $data = $request->all();

        $mediaFieldName = $mediaInfo['upload_field'] ;
        $mediaGroup = $mediaInfo['upload_group'];
        $mediaAttachFieldName = $mediaInfo['attach_field'];

        if (isset($data[$mediaFieldName])) {

            // Check if array (multiple files)
            if ( is_array($data[$mediaFieldName]) ) {

                if (count($data[$mediaFieldName]) > 0) {
                    foreach ($data[$mediaFieldName] as $key => $value) {

                        $fileName = $data[$mediaFieldName][$key]->getClientOriginalName();
                        $fileDescription = '';

                        $fileCreatedAt = now();
                        if (isset($request['fileCreatedAt'])) {
                            $fileCreatedAt = $request['fileCreatedAt'];
                        }
            
                        $media = MediaUploader::fromFile($value)
                            ->useFileCreatedAt($fileCreatedAt)
                            ->useUploadFolder($mediaGroup)
                            ->useFileDescription($fileDescription)
                            ->useUserId(Auth::user() ? Auth::user()->id : '')
                            ->useName($fileName)
                            ->upload();
            
                            $this->attachMedia($media, $mediaGroup);
                    }
                }

            } else {
                $fileName = $data[$mediaFieldName]->getClientOriginalName();
                $fileDescription = '';

                $fileCreatedAt = now();
                if (isset($request['fileCreatedAt'])) {
                    $fileCreatedAt = $request['fileCreatedAt'];
                }
    
                $media = MediaUploader::fromFile($data[$mediaFieldName])
                    ->useUploadFolder($mediaGroup)
                    ->useFileDescription($fileDescription)
                    ->useUserId(Auth::user() ? Auth::user()->id : '')
                    ->useName($fileName)
                    ->useFileCreatedAt($fileCreatedAt)
                    ->upload();
    
                    $this->attachMedia($media, $mediaGroup);
            }

        }

        // Attach existing file/files if provided
        if (isset($data[$mediaAttachFieldName])) {
            // Check if array (multiple files)
            if (is_array($data[$mediaAttachFieldName])) {
                // attach all ids using a loop
                foreach ($data[$mediaAttachFieldName] as $key => $value) {
                    $media = Media::findOrFail($value);
                    $this->attachMedia($media, $mediaGroup);
                }
            } else {
                $media = Media::findOrFail($data[$mediaAttachFieldName]);
                $this->attachMedia($media, $mediaGroup);
            }
        }

        return true;
    }

}
