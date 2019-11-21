<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\User;
use App\UsersProvider;
use App\ServicesCatalogue;
use Image;
use App\Http\Requests\uploadImage;
use App\Http\Requests\uploadBanner;
use App\Http\Requests\uploadCatalogueImage;
use Validator;
use Illuminate\Support\Facades\Storage;
use File;
use App\Helpers\Image as ImageHelper;

class MediaController extends Controller
{
	/**
	 * Uploads the user's profile image.
	 *
	 * @param      \Illuminate\Http\Request         $request  The request
	 *
	 * @return     \Illuminate\Http\Request|string  ( Succes code )
	 */
    public function uploadProfileImage(uploadImage $request){

    	$user = auth()->user();

    	if ($user->profile_img != null){
    		Storage::delete($user->profile_img);
    	}
    	
        $path = $request->image->store('profile_images');

        $user->profile_img = $path;
        $user->save();

        return response('Profile image succesfully uploaded', 200);

    }

    /**
     * Uploads a provider banner.
     *
     * @param      \App\Http\Requests\uploadImage  $request  The request
     *
     * @return     <type>                          ( Response code )
     */
    public function uploadProviderBanner(uploadBanner $request){

        $user_provider = auth()->user()->usersProvider;

        if ($user_provider->provider_banner != null){
            Storage::delete($user_provider->provider_banner);
        }
        
        $path = $request->image->store('providers_banners');

        $user_provider->provider_banner = $path;
        $user_provider->save();

        return response('Provider banner succesfully uploaded', 200);
    }

    /**
     * Uploads a catalogue image.
     *
     * @param      \App\Http\Requests\uploadCatalogueImage  $request  The request
     *
     * @return     <type>                                   ( Response code )
     */
    public function uploadCatalogueImage(uploadCatalogueImage $request){

        $catalogue = ServicesCatalogue::find($request->id);

        if ($catalogue->img != null){
            Storage::delete($catalogue->img);
        }
        
        $path = $request->image->store('catalogues_images');

        $catalogue->img = $path;
        $catalogue->save();

        return response('Catalogue image succesfully uploaded', 200);
    }

    public function getProfileImage($id){
        $data = [
            'id' => $id
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();

        if ($user->profile_img != null){
            try{
                $content = Storage::get($user->profile_img);
            } 
            catch (FileNotFoundException $error){
                return response('Profile image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user->profile_img, 'original');

            $img = Image::cache(function($image) use ($content) {
                $image->make($content);
            }, 10, true);

            return $img->response();
        }

        return response('The user does not have a profile image', 404);
    }

    /**
     * Gets the provider banner.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The provider banner.
     */
    public function getProviderBanner($id){
        $data = [
            'id' => $id
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users_providers,user_id'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();
        $user_provider = $user->usersProvider;

        if ($user_provider->provider_banner != null){
            try{
                $content = Storage::get($user_provider->provider_banner);
            } 
            catch (FileNotFoundException $error){
                return response('Provider banner not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user_provider->provider_banner, 'original');

            $img = Image::cache(function($image) use ($content) {
                $image->make($content);
            }, 10, true);

            return $img->response();
        }

        return response('The provider does not have a provider banner', 404);
    }

    /**
     * Gets the provider banner.
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  The provider banner.
     */
    public function getCatalogueImage($id){
        $data = [
            'id' => $id
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:services_catalogues,id'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $catalogue = ServicesCatalogue::where('id', $id)->first();

        if ($catalogue->img != null){
            try{
                $content = Storage::get($catalogue->img);
            } 
            catch (FileNotFoundException $error){
                return response('Catalogue image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($catalogue->img, 'original');

            $img = Image::cache(function($image) use ($content) {
                $image->make($content);
            }, 10, true);

            return $img->response();
        }

        return response('The catalogue does not have an image', 404);
    }

    /**
     * Return the thumb size of the user's profile image
     *
     * @param      string  $id     The identifier
     * @param      number  $size   The size
     *                                                                      
     * @return     mixed  
     */
    public function thumbProfileImage($id, $size){

        $data = [
            'id' => $id, 
            'size' => $size
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users,id',
            'size' => 'required|numeric|max:500',
    
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();

        if ($user->profile_img != null){

            try{
                $content = Storage::get($user->profile_img);
            } 
            catch (FileNotFoundException $error){
                return response('Profile image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user->profile_img, $size);

            $img = Image::cache(function($image) use ($content, $size) {
                $image->make($content)->fit($size);
            }, 10, true);

            return $img->response();
        }

        return response('The user does not have a profile image', 404);

    }

    /**
     * Returns the thumb size of the provider banner
     *
     * @param      <type>  $id     The identifier
     * @param      <type>  $size   The size
     *
     * @return     <type>  ( mixed )
     */
    public function thumbProviderBanner($id, $size){

        $data = [
            'id' => $id, 
            'size' => $size
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users_providers,user_id',
            'size' => 'required|numeric|max:500',
    
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();
        $user_provider = $user->usersProvider;

        if ($user_provider->provider_banner != null){

            try{
                $content = Storage::get($user_provider->provider_banner);
            } 
            catch (FileNotFoundException $error){
                return response('Provider banner not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user_provider->provider_banner, $size);

            $img = Image::cache(function($image) use ($content, $size) {
                $image->make($content)->fit($size);
            }, 10, true);

            return $img->response();
        }

        return response('The provider does not have a provider banner', 404);

    }

    /**
     * Returns the thumb size of the catalogue image
     *
     * @param      <type>  $id     The identifier
     * @param      <type>  $size   The size
     *
     * @return     <type>  ( mixed )
     */
    public function thumbCatalogueImage($id, $size){

        $data = [
            'id' => $id, 
            'size' => $size
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:services_catalogues,id',
            'size' => 'required|numeric|max:500',
    
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $catalogue = ServicesCatalogue::where('id', $id)->first();

        if ($catalogue->img != null){

            try{
                $content = Storage::get($catalogue->img);
            } 
            catch (FileNotFoundException $error){
                return response('Catalogue image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($catalogue->img, $size);

            $img = Image::cache(function($image) use ($content, $size) {
                $image->make($content)->fit($size);
            }, 10, true);

            return $img->response();
        }

        return response('The catalogue does not have a image', 404);

    }

    /**
     * Return the cropped version of the user's profile image
     *
     * @param      string  $id      The identifier
     * @param      number  $width   The width
     * @param      number  $height  The height
     *
     * @return     mixed  
     */
    public function cropProfileImage($id, $width, $height){

        $data = [
            'id' => $id, 
            'width' => $width,
            'height' => $height
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users,id',
            'width' => 'required|numeric|max:500',
            'height' => 'required|numeric|max:500'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();

        if ($user->profile_img != null){
            try{
                $content = Storage::get($user->profile_img);
            } 
            catch (FileNotFoundException $error){
                return response('Profile image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user->profile_img, $width . 'x' . $height);

            $img = Image::cache(function($image) use ($content, $width, $height) {
                $image->make($content)->fit($width, $height);
            }, 10, true);

            return $img->response();
        }

        return response('The user does not have a profile image', 404);

    }

    /**
     * Return the cropped version of the provider banner
     *
     * @param      string  $id      The identifier
     * @param      number  $width   The width
     * @param      number  $height  The height
     *
     * @return     mixed  
     */
    public function cropProviderBanner($id, $width, $height){

        $data = [
            'id' => $id, 
            'width' => $width,
            'height' => $height
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users_providers,user_id',
            'width' => 'required|numeric|max:500',
            'height' => 'required|numeric|max:500'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();
        $user_provider = $user->usersProvider;

        if ($user_provider->provider_banner != null){

            try{
                $content = Storage::get($user_provider->provider_banner);
            } 
            catch (FileNotFoundException $error){
                return response('Provider banner not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user_provider->provider_banner, $width . 'x' . $height);

            $img = Image::cache(function($image) use ($content, $width, $height) {
                $image->make($content)->fit($width, $height);
            }, 10, true);

            return $img->response();
        }

        return response('The provider does not have a provider banner', 404);

    }

    /**
     * Return the cropped version of the catalogue image
     *
     * @param      string  $id      The identifier
     * @param      number  $width   The width
     * @param      number  $height  The height
     *
     * @return     mixed  
     */
    public function cropCatalogueImage($id, $width, $height){

        $data = [
            'id' => $id, 
            'width' => $width,
            'height' => $height
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:services_catalogues,id',
            'width' => 'required|numeric|max:500',
            'height' => 'required|numeric|max:500'
    
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $catalogue = ServicesCatalogue::where('id', $id)->first();

        if ($catalogue->img != null){

            try{
                $content = Storage::get($catalogue->img);
            } 
            catch (FileNotFoundException $error){
                return response('Catalogue image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($catalogue->img, $width . 'x' . $height);

            $img = Image::cache(function($image) use ($content, $width, $height) {
                $image->make($content)->fit($width, $height);
            }, 10, true);

            return $img->response();
        }

        return response('The catalogue does not have a image', 404);

    }

    /**
     * Return the resize version of the profile image
     *
     * @param      <type>  $id      The identifier
     * @param      string  $width   The width
     * @param      <type>  $height  The height
     *
     * @return     <type>  ( mixed )
     */
    public function resizeProfileImage($id, $width, $height){

        $data = [
            'id' => $id, 
            'width' => $width,
            'height' => $height
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users,id',
            'width' => 'required|numeric|max:1000',
            'height' => 'required|numeric|max:1000'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();

        if ($user->profile_img != null){
            try{
                $content = Storage::get($user->profile_img);
            } 
            catch (FileNotFoundException $error){
                return response('Profile image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user->profile_img, $width . 'x' . $height);

            $img = Image::cache(function($image) use ($content, $width, $height) {
                $image->make($content)->resize($width, $height);
            }, 10, true);

            return $img->response();
        }

        return response('The user does not have a profile image', 404);

    }

    /**
     * Return the resize version of the provider banner
     *
     * @param      string  $id      The identifier
     * @param      number  $width   The width
     * @param      number  $height  The height
     *
     * @return     mixed  
     */
    public function resizeProviderBanner($id, $width, $height){

        $data = [
            'id' => $id, 
            'width' => $width,
            'height' => $height
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:users_providers,user_id',
            'width' => 'required|numeric|max:500',
            'height' => 'required|numeric|max:500'
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $user = User::where('id', $id)->first();
        $user_provider = $user->usersProvider;

        if ($user_provider->provider_banner != null){

            try{
                $content = Storage::get($user_provider->provider_banner);
            } 
            catch (FileNotFoundException $error){
                return response('Provider banner not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($user_provider->provider_banner, $width . 'x' . $height);

            $img = Image::cache(function($image) use ($content, $width, $height) {
                $image->make($content)->resize($width, $height);
            }, 10, true);

            return $img->response();
        }

        return response('The provider does not have a provider banner', 404);

    }

    /**
     * Return the resize version of the catalogue image
     *
     * @param      string  $id      The identifier
     * @param      number  $width   The width
     * @param      number  $height  The height
     *
     * @return     mixed  
     */
    public function resizeCatalogueImage($id, $width, $height){

        $data = [
            'id' => $id, 
            'width' => $width,
            'height' => $height
        ];

        $validator = Validator::make($data, [
            'id' => 'required|exists:services_catalogues,id',
            'width' => 'required|numeric|max:500',
            'height' => 'required|numeric|max:500'
    
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }

        $catalogue = ServicesCatalogue::where('id', $id)->first();

        if ($catalogue->img != null){

            try{
                $content = Storage::get($catalogue->img);
            } 
            catch (FileNotFoundException $error){
                return response('Catalogue image not found', 404);
            }

            //Set the image headers to use cache
            ImageHelper::set_image_headers($catalogue->img, $width . 'x' . $height);

            $img = Image::cache(function($image) use ($content, $width, $height) {
                $image->make($content)->resize($width, $height);
            }, 10, true);

            return $img->response();
        }

        return response('The catalogue does not have a image', 404);

    }
}
