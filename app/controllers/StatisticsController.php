<?php

namespace Abstaff\Controllers;

use Abstaff\Models\Users as Users,
	Abstaff\Models\UserGroups as UserGroups,
	Abstaff\Models\Articles as Articles,
	Abstaff\Models\ArticleCategories as ArticleCategories,
	Abstaff\Models\Pages as Pages,
	Abstaff\Models\Series as Series,
	Abstaff\Models\Episodes as Episodes,
	Abstaff\Models\Mirrors as Mirrors,
	Abstaff\Models\Videohosts as Videohosts,
	Abstaff\Models\MirrorTypes as MirrorTypes;
	
class StatisticsController extends ControllerBase
{

	public function indexAction()
	{
		$total['users'] = count(Users::find());
		$total['articles'] = count(Articles::find());
		$total['pages'] = count(Pages::find());
		$total['series'] = count(Series::find());
		$total['episodes'] = count(Episodes::find());
		$total['mirrors'] = count(Mirrors::find());
		$total['mirrortypes'] = count(MirrorTypes::find());
		
		$this->view->setVar('total', $total);
	}

}
	