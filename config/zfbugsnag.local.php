<?php
return [
    'zf-bugsnag' => [
		'enabled'				=>	true,
		'api_key'				=>	'YOUR-API-KEY-HERE',

		'releaseStage'			=>	'development',
		'notifyReleaseStages'	=>	['development', 'production'],
		'sendEnvironment'		=>	false,

		'autoNotify'			=>	true,
    ],
];