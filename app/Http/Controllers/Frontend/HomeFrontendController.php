<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Section_content;
use App\Models\Section_manage;
use App\Models\Tp_option;
class HomeFrontendController extends Controller
{
	//Get Frontend Data
    public function homePageLoad(Request $request)
	{
		$lan = glan();
		
		$PageVariation = PageVariation();
		
		//Home Page 1
		if($PageVariation['home_variation'] == 'home_1'){
			
			//slider_hero Section
			$slider_hero_section = Section_manage::where('manage_type', '=', 'home_1')->where('section', '=', 'slider_hero')->where('is_publish', '=', 1)->first();
			if($slider_hero_section ==''){
				$slider_hero_array =  array();
				$slider_hero_array['image'] = '';
				$slider_hero_array['is_publish'] = 2;
				$slider_hero_section = json_decode(json_encode($slider_hero_array));
			}
			
			
			//Featured Rooms Section
			$featured_rooms_section = Section_manage::where('manage_type', '=', 'home_1')->where('section', '=', 'featured_rooms')->where('is_publish', '=', 1)->first();
			if($featured_rooms_section ==''){
				$featured_rooms_array =  array();
				$featured_rooms_array['image'] = '';
				$featured_rooms_array['is_publish'] = 2;
				$featured_rooms_section = json_decode(json_encode($featured_rooms_array));
			}
			
			
			//Testimonial Section
			$testimonial_section = Section_manage::where('manage_type', '=', 'home_1')->where('section', '=', 'testimonial')->where('is_publish', '=', 1)->first();
			if($testimonial_section ==''){
				$testimonial_array =  array();
				$testimonial_array['image'] = '';
				$testimonial_array['is_publish'] = 2;
				$testimonial_section = json_decode(json_encode($testimonial_array));
			}
			
			//Slider
			$slider = Slider::where('slider_type', '=', 'home_1')->where('is_publish', '=', 1)->orderBy('id', 'desc')->limit(1)->get();
			

			//Featured Rooms
			$featured_rooms = DB::table('rooms')
				->join('categories', 'rooms.cat_id', '=', 'categories.id')
				->select('rooms.*', 'categories.name as category_name', 'categories.slug as category_slug')
				->where('rooms.is_publish', '=', 1)
				->where('rooms.is_featured', '=', 1)
				->where('rooms.lan', '=', $lan)
				->orderBy('rooms.id','desc')
				->limit(6)
				->get();
				
			//Home Video Section
			$hv_data = Tp_option::where('option_name', 'home-video')->get();
			$id_home_video = '';
			foreach ($hv_data as $row){
				$id_home_video = $row->id;
			}

			$home_video = array();
			if($id_home_video != ''){
				$hvData = json_decode($hv_data);
				$dataObj = json_decode($hvData[0]->option_value);
				
				$home_video['title'] = $dataObj->title;
				$home_video['short_desc'] = $dataObj->short_desc;
				$home_video['url'] = $dataObj->url;
				$home_video['video_url'] = $dataObj->video_url;
				$home_video['button_text'] = $dataObj->button_text;
				$home_video['target'] = $dataObj->target;
				$home_video['image'] = $dataObj->image;
				$home_video['is_publish'] = $dataObj->is_publish;
			}else{
				$home_video['title'] = '';
				$home_video['short_desc'] = '';
				$home_video['url'] = '';
				$home_video['video_url'] = '';
				$home_video['button_text'] = '';
				$home_video['target'] = '';
				$home_video['image'] = '';
				$home_video['is_publish'] = '2';
			}
			
			//Testimonial
			$testimonial = Section_content::where('section_type', '=', 'testimonial')->where('is_publish', '=', 1)->get();

		//Home Page 2
		}elseif($PageVariation['home_variation'] == 'home_2'){
			
		//Home Page 3
		}elseif($PageVariation['home_variation'] == 'home_3'){
			
		//Home Page 4
		}elseif($PageVariation['home_variation'] == 'home_4'){
			
		}
		
        return view('frontend.home', compact(
			'slider_hero_section',
			'featured_rooms_section',
			'slider',
			'featured_rooms',
			'testimonial'
		));
    }
}
