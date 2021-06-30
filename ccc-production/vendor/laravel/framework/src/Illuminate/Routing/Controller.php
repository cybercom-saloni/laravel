<?php

namespace Illuminate\Routing;

use BadMethodCallException;

abstract class Controller
{
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Register middleware on the controller.
     *
     * @param  \Closure|array|string  $middleware
     * @param  array  $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return $this->{$method}(...array_values($parameters));
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }

    function resizeImage($filename,$imageWidth,$imageHeight,$mime,$width,$height,$imageName)
    {
        echo $imageName;
        if($mime=='image/jpeg')
        {
            $newImage = imagecreatetruecolor($width,$height);
            $source = imagecreatefromjpeg($filename);
            imagecopyresized($newImage,$source,0,0,0,0,$width,$height,$imageWidth,$imageHeight);
            $resizeImageName=  $filename->getClientOriginalName();
            if($width == 100 && $height == 100)
            {
                imagejpeg($newImage,public_path("images/products/cache/100x100/$resizeImageName"));
            }
            if($width == 200 && $height == 200)
            {
                imagejpeg($newImage,public_path("images/products/cache/200x200/$resizeImageName"));
            }
            // $filename->move(public_path("images/products/real/$id"), $imageName);

        }
        elseif($mime=='image/png')
        {
            $newImage = imagecreatetruecolor($width,$height);
            $source = imagecreatefrompng($filename);
            imagecopyresized($newImage,$source,0,0,0,0,$width,$height,$imageWidth,$imageHeight);
            $resizeImageName= $filename->getClientOriginalName();
            if($width == 100 && $height == 100)
            {
                imagepng($newImage,public_path("images/products/cache/100x100/$resizeImageName"));
            }
            if($width == 200 && $height == 200)
            {
                imagepng($newImage,public_path("images/products/cache/200x200/$resizeImageName"));
            }
        }
        elseif($mime=='image/gif')
        {

            $newImage = imagecreatetruecolor($width,$height);
            $source = imagecreatefromgif($filename);
            imagecopyresized($newImage,$source,0,0,0,0,$width,$height,$imageWidth,$imageHeight);
            $resizeImageName= $filename->getClientOriginalName();
            if($width == 100 && $height == 100)
            {
                imagegif($newImage,public_path("images/products/cache/100x100/$resizeImageName"));
            }
            if($width == 200 && $height == 200)
            {
                imagegif($newImage,public_path("images/products/cache/200x200/$resizeImageName"));
            }
        }


    }

}
