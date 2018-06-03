// $asset_class = Input::get('asset_class');
// 		$geo_interests = Input::get('geo_interests');
// 		$pe_sector_interests = Input::get('pe_sector_interests');
// 		$re_sector_interests = Input::get('re_sector_interests');
// 		$vc_sector_interests = Input::get('vc_sector_interests');
// 		$pe_deal_size = Input::get('pe_deal_size');
// 		$re_deal_size = Input::get('re_deal_size');
// 		$vc_deal_size = Input::get('vc_deal_size');
// 		$timer = Input::get('timer');

// 		$user = Auth::user();	

// 		if($user->skiped == 1 || $user->rule_id == 4){
// 			$q = Company::select(array('*'));

// 			/* Filters */
// 			if(Input::get('search_investments')){
// 	        	$q = $q ->where(function($q){
// 	        		$q	->orWhere('name','LIKE', '%' . Input::get('search_investments') . '%')
// 	        			->orWhere('name_arabic','LIKE','%' . Input::get('search_investments') . '%')
// 	        			->orWhere('deal_name','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('country','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('city','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('description','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('brief','LIKE','%' . Input::get('search_investments') . '%');
// 	        	});
// 	        }

// 	        if($geo_interests){
// 	        	foreach($geo_interests as $geo){
// 	        		$q->where('geo_interests','LIKE', '%' . $geo . '%');
// 	        	}
//         	}

// 			$date = date('Y-m-d');
// 			if($timer){
// 				switch($timer){
// 					case 'finished':
// 						$q->where('enddate','<', $date);
// 						break;
// 					case 'investable':
// 						$q->where('enddate','>=', $date);
// 						break;
// 					case 'soon':
// 						$oneWeek = date('Y-m-d', strtotime("+1 week"));
// 						$q->where('enddate' , '<=', $oneWeek)
// 							->where('enddate' , '>', $date);
// 						break;
// 					case 'featured':
// 						$q->where('featured','=', 1);
// 						break;
// 				}
// 	        }

// 			if($asset_class == 'pe'){
// 				$q->where('type','=', 'pe' );
// 				if($pe_sector_interests){
// 					foreach ($pe_sector_interests as $sector) {
// 						$q->where('sector','LIKE','%' . $sector . '%');
// 					}
// 				}
// 				if($pe_deal_size){
// 					foreach ($pe_deal_size as $deal) {
// 						$q->where('deal_size','LIKE','%' . $deal . '%');
// 					}
// 				}
// 			}

// 			if($asset_class == 're'){
// 				$q->where('type','=', 're' );
// 				if($re_sector_interests){
// 					foreach ($re_sector_interests as $sector) {
// 						$q->where('sector','LIKE','%' . $sector . '%');
// 					}
// 				}
// 				if($re_deal_size){
// 					foreach ($re_deal_size as $deal) {
// 						$q->where('deal_size','LIKE','%' . $deal . '%');
// 					}
// 				}
// 			}

// 			if($asset_class == 'vc'){
// 				$q->where('type','=', 'vc' );
// 				if($vc_sector_interests){
// 					foreach ($vc_sector_interests as $sector) {
// 						$q->where('sector','LIKE','%' . $sector . '%');
// 					}
// 				}
// 				if($vc_deal_size){
// 					foreach ($vc_deal_size as $deal) {
// 						$q->where('deal_size','LIKE','%' . $deal . '%');
// 					}
// 				}
// 			}
// 		}else{
// 			if( is_null($user->pe_interested) && is_null($user->re_interested) && is_null($user->vc_interested) ){
// 				$q = Company::select(array('*'));
// 				$byScore = false;
// 			}else{

// 				$ifStatment = "";
// 				//PE
// 				if(!is_null($user->pe_interested) && $user->pe_interested != 0 ){
					
// 					$numItemsPE = count($user->pe_geo_interests);
// 					$i = 0;

// 					foreach ($user->pe_geo_interests as $geo) {
// 						$ifStatment .= 'IF(geo_interests like "%' .  $geo .'%", 1, 0) + ';
// 					}
					
// 					$ifStatment .= ' 4 * (';

// 					foreach ($user->pe_geo_interests as $geo) {
// 						if(++$i === $numItemsPE) {
// 							$ifStatment .= 'geo_interests like "%'. $geo .'%" ' ;
// 						}else{
// 							$ifStatment .= 'geo_interests like "%'. $geo .'%" OR ' ;
// 						}
// 					}
// 					$ifStatment .= ')';
// 					$ifStatment .= ' + IF(type = "pe", 20, 0) + IF(sector IN ("' . arrayToSqlString($user->pe_sector_interests) . '"), 3, 0) +
// 					IF(investment_stage IN ("' . arrayToSqlString($user->pe_investment_stage) . '"), 3, 0) +
// 					IF(deal_size IN ("' . arrayToSqlString($user->pe_deal_size) . '"), 3, 0) + 
// 					IF(now() >= startdate, 1, 0)';
// 				}
// 				//RE
// 				if(!is_null($user->re_interested) && $user->re_interested != 0){

// 					$numItemsRE = count($user->re_geo_interests);
// 					$i = 0;

// 					foreach ($user->re_geo_interests as $geo) {
// 						$ifStatment .= ' + IF(geo_interests like "%' . $geo .'%", 1, 0) ';
// 					}

// 					$ifStatment .= ' + 4 * (';

// 					foreach ($user->re_geo_interests as $geo) {
// 						if(++$i === $numItemsRE) {
// 							$ifStatment .= 'geo_interests like "%'. $geo .'%" ' ;
// 						}else{
// 							$ifStatment .= 'geo_interests like "%'. $geo .'%" OR ' ;
// 						}
// 					}
// 					$ifStatment .= ')';
// 					$ifStatment .= ' + IF(type = "re", 20, 0) + IF(sector IN ("' . arrayToSqlString($user->re_sector_interests) . '"), 3, 0) +
// 					IF(investment_stage IN ("' . arrayToSqlString($user->re_investment_stage) . '"), 3, 0) +
// 					IF(deal_size IN ("' . arrayToSqlString($user->re_deal_size) . '"), 3, 0) + 
// 					IF(now() >= startdate, 1, 0)';

// 				}
// 				//VC
// 				if(!is_null($user->vc_interested) && $user->vc_interested != 0){
// 					$numItemsVC = count($user->vc_geo_interests);
// 					$i = 0;

// 					foreach ($user->vc_geo_interests as $geo) {
// 						$ifStatment .= ' + IF(geo_interests like "%' . $geo .'%", 1, 0) ';
// 					}

// 					$ifStatment .= ' + 4 * (';

// 					foreach ($user->vc_geo_interests as $geo) {
// 						if(++$i === $numItemsVC) {
// 							$ifStatment .= 'geo_interests like "%'. $geo .'%" ' ;
// 						}else{
// 							$ifStatment .= 'geo_interests like "%'. $geo .'%" OR ' ;
// 						}
// 					}
// 					$ifStatment .= ')';
// 					$ifStatment .= ($ifStatment == "" ? $ifStatment : ' + ');
// 					$ifStatment .= ' + IF(type = "vc", 20, 0) + IF(sector IN ("' . arrayToSqlString($user->vc_sector_interests) . '"), 3, 0) +
// 					IF(investment_stage IN ("' . arrayToSqlString($user->vc_investment_stage) . '"), 3, 0) +
// 					IF(deal_size IN ("' . arrayToSqlString($user->vc_deal_size) . '"), 3, 0) + 
// 					IF(now() >= startdate, 1, 0)';
// 				}
			
// 				$ifStatment .= ' AS score';
				
// 				$q = Company::select(DB::raw('*,'. $ifStatment));
// 				$byScore = true;
// 			}
			
// 			/* Filters */
// 			if(Input::get('search_investments')){
// 	        	$q = $q ->where(function($q){
// 	        		$q	->orWhere('name','LIKE', '%' . Input::get('search_investments') . '%')
// 	        			->orWhere('name_arabic','LIKE','%' . Input::get('search_investments') . '%')
// 	        			->orWhere('deal_name','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('country','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('city','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('description','LIKE','%' . Input::get('search_investments') . '%')
// 					    ->orWhere('brief','LIKE','%' . Input::get('search_investments') . '%');
// 	        	});
// 	        }

// 	        if($geo_interests){
// 	        	foreach($geo_interests as $geo){
// 	        		$q->orWhere('geo_interests','LIKE', '%' . $geo . '%');
// 	        	}
//         	}

//         	$date = date('Y-m-d');
// 			if($timer){
// 				switch($timer){
// 					case 'finished':
// 						$q->where('enddate','<', $date);
// 						break;
// 					case 'investable':
// 						$q->where('enddate','>=', $date);
// 						break;
// 					case 'soon':
// 						$oneWeek = date('Y-m-d', strtotime("+1 week"));
// 						$q	->where('enddate' , '<=', $oneWeek)
// 							->where('enddate' , '>', $date);
// 						break;
// 					case 'featured':
// 						$q->where('featured','=', 1);
// 						break;
// 				}
// 	        }

// 			if($asset_class == 'pe'){
// 				$q->where('type','=', 'pe' );
// 				if($pe_sector_interests){
// 					foreach ($pe_sector_interests as $sector) {
// 						$q->where('sector','LIKE','%' . $sector . '%');
// 					}
// 				}
// 				if($pe_deal_size){
// 					foreach ($pe_deal_size as $deal) {
// 						$q->where('deal_size','LIKE','%' . $deal . '%');
// 					}
// 				}
// 			}

// 			if($asset_class == 're'){
// 				$q->where('type','=', 're' );
// 				if($re_sector_interests){
// 					foreach ($re_sector_interests as $sector) {
// 						$q->where('sector','LIKE','%' . $sector . '%');
// 					}
// 				}
// 				if($re_deal_size){
// 					foreach ($re_deal_size as $deal) {
// 						$q->where('deal_size','LIKE','%' . $deal . '%');
// 					}
// 				}
// 			}

// 			if($asset_class == 'vc'){
// 				$q->where('type','=', 'vc' );
// 				if($vc_sector_interests){
// 					foreach ($vc_sector_interests as $sector) {
// 						$q->where('sector','LIKE','%' . $sector . '%');
// 					}
// 				}
// 				if($vc_deal_size){
// 					foreach ($vc_deal_size as $deal) {
// 						$q->where('deal_size','LIKE','%' . $deal . '%');
// 					}
// 				}
// 			}

// 			if( $byScore == true)
// 				$q = $q->orderBy('score', 'desc');
// 		}

// 		$q->where('startdate', '<=', $date);
// 		$q->where('approved', '=', 1);
// 		$q->where('status', '=', 'published');
// 		$q->orderBy('id', 'desc');

//         $companies = $q->paginate(12);

//         return View::make('profile.common.home')->with('companies', $companies)
//         											   ->with('asset_class', $asset_class)
//         											   ->with('topmenu', 'home');