<?php
return [
	'zf-bugsnag' => [
		/**
		 * Enabled
		 * is the ZfBugsnag Application enabled?
		 * Default: true
		 */
		'enabled' => true,

		/**
		 * ApiKey
		 * The ApiKey you can find on your Bugsnag dashboard
		 */
		'api_key' => 'YOUR-API-KEY-HERE',

		/**
		 * releaseStage
		 * The ReleaseStage that the error occurred in
		 * Default: development
		 */
		'releaseStage' => 'development',

		/**
		 * notifyReleaseStages
		 * Which ReleaseStages should send notifications to Bugsnag?
		 * Default: ['development', 'production']
		 */
		'notifyReleaseStages' => ['development', 'production'],

		/**
		 * sendEnvironment
		 * Bugsnag can diagnose your $_ENV environment to help fixing your issues.
		 * This can contain private/sensitive information, so be carefull when you enabled this
		 * Default: false
		 */
		'sendEnvironment' => false,

		/**
		 * autoNotify
		 * The ZfBugsnag will notify Bugsnag of any uncaught exception (if possible)
		 * Default: true
		 */
		'autoNotify' => true,

		/**
		 * appVersion
		 * The version of the application that will be sent to BugSnag,
		 * useful when fixing errors so Bugsnag reports errors if they appear
		 * in a new version of the app.
		 */
		'appVersion' => '1.0.0'
	],
];