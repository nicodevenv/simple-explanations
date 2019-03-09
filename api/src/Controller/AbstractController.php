<?php

	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Request;

	class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
	{
		public function getPostData(Request $request)
		{
			return $request->request->all();
		}
	}
