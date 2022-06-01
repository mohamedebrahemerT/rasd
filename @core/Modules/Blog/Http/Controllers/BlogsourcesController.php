<?php

namespace Modules\Blog\Http\Controllers;

use App\Blog;
use App\Blogsources;
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use App\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Nwidart\Modules\Routing\Controller;

class BlogsourcesController extends Controller
{
    public $languages = null;
    private const BASE_PATH = 'blog::backend.';
    public function __construct()
    {
        if ($this->languages === null){
            $this->languages =  $all_languages = Language::all();
        }
        //Blog sources
        $this->middleware('auth:admin');
        $this->middleware('permission:blog-sources-list|blog-sources-create|blog-sources-edit|blog-sources-delete',['only' => ['index']]);
        $this->middleware('permission:blog-sources-create',['only' => ['new_sources']]);
        $this->middleware('permission:blog-sources-edit',['only' => ['update_sources']]);
        $this->middleware('permission:blog-sources-delete',['only' => ['delete_sources','bulk_action','delete_sources_all_lang']]);
    }

    public function index(Request $request){
        $lang= $request->lang ?? LanguageHelper::default_slug();
         app()->setLocale($lang);
         $all_sources = Blogsources::select(['id','title','status','image'])->get();
        return view(self::BASE_PATH.'blog.sources')->with([
            'all_sources' => $all_sources,
            'default_lang' => $request->lang ?? LanguageHelper::default_slug(),
        ]);
    }

    public function new_sources(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:blog_categories',
            'status' => 'required|string|max:191',
            'image' => 'sometimes|nullable|string|max:191',
        ]);

        $sources = new Blogsources();
        $sources
            ->setTranslation('title',$request->lang, purify_html($request->title));
            $sources->status = $request->status;
            $sources->image = $request->image;
            $sources->save();
             return redirect()->back()->with(FlashMsg::item_new('Blog sources Added'));
    }

    public function update_sources(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:blog_categories',
            'status' => 'required|string|max:191',
        ]);

        $sources =  Blogsources::findOrFail($request->id);
        $sources
            ->setTranslation('title',$request->lang, purify_html($request->title));
            $sources->status = $request->status;
            $sources->image = $request->image;
            $sources->save();

        return back()->with(FlashMsg::item_update());
    }


    public function delete_sources_all_lang(Request $request,$id){

        if (Blog::where('sources_id',$id)->first())
        {
            return redirect()->back()->with([
                'msg' => __('You can not delete this sources, It already associated with a post...'),
                'type' => 'danger'
            ]);
        }
        $sources =  Blogsources::where('id',$id)->first();
        $sources->delete();

        return back()->with(FlashMsg::item_delete());
    }


    public function bulk_action(Request $request){
        Blogsources::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

}
