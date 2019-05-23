<?php
namespace Excellence\UiForm\Api\Data;

/**
 * @api
 */
interface ImageInterface
{
    const IMAGE_ID          = 'image_id';
    const IMAGE             = 'image';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get image
     *
     * @return string
     */
    public function getImage();


    /**
     * Set ID
     *
     * @param $id
     * @return ImageInterface
     */
    public function setId($id);

    /**
     * Set image
     *
     * @param $image
     * @return ImageInterface
     */
    public function setImage($image);
}
