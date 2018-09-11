<?php  


 function check_user_permissions($request, $actionName = NULL, $id = NULL)
{
	//get current user
	$currentUser = $request->user();

	//get current action name
	if ($actionName) {
		$currentActionName = $actionName;
	}else
	{
		$currentActionName = $request->route()->getActionName();
	}
	list($controller,$method) = explode('@',$currentActionName);
	$controller = str_replace(["App\\Http\\Controllers\\Backend\\","Controller"],"",$controller);

	$crudPermissionsMap = [
	    // 'create' => ['create','store'],
	    // 'update' => ['edit','update'],
	    // 'delete' => ['destroy','restore', 'forceDestroy'],
	    // 'read' => ['index', 'view']
	    'crud' => ['create','store','edit','update','destroy','restore','forceDestroy','index','view']
	];
	$classesMap =[
	    'Blog' =>'post',
	    'Categories' =>'category',
	    'Users' => 'user'
	];
	foreach ($crudPermissionsMap as $permission => $methods) {
	    //if current user method exists in the methods list,
	    //we will check the permission
	    if (in_array($method, $methods) && isset($classesMap[$controller])) {
	        $className = $classesMap[$controller];

	        if ($className == 'post' && in_array($method, ['edit','update','destroy','restore', 'forceDestroy'])) {
	        	$id = !is_null($id) ? $id : $request->route('blog');
	           //if the current user has not update-other-post/delete-other-post permission, then make sure he/she only modify his/her own post

	            if ($id && (!$currentUser->can('update-other-post') || !$currentUser->can('delete-other-post'))) {
	                $post = \App\Post::withTrashed()->find($id);
	                if ($post->author_id !== $currentUser->id) {
	                    return false;
	                }
	                
	            }

	        }
	        //if the user dont have permission, dont allow next request 
	        if(! $currentUser->can("{$permission}-{$className}"))
	        {
	            return false;
	        }
	        break;
	    }
	}
	
	return true;
}

