<?php
namespace Rfd\ImageMagick\Operation;

use Rfd\ImageMagick\Options\CommonOptions;

abstract class Extent extends Operation {
    /** @var int */
    protected $width;

    /** @var int */
    protected $height;

    /** @var string */
    protected $gravity = CommonOptions::GRAVITY_CENTER;

    /**
     * @param string $gravity
     *
     * @return $this
     */
    public function setGravity($gravity) {
        $this->gravity = $gravity;

        return $this;
    }

    /**
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height) {
        $this->height = $height;

        return $this;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width) {
        $this->width = $width;

        return $this;
    }
}