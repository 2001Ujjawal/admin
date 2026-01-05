<?php

use CodeIgniter\HTTP\IncomingRequest;

if (!function_exists('api_log')) {
    function api_log(
        string $status,
        string $message,
        array $extraData = [],
        string $fileName = 'api.log'
    ): void {
        $request = service('request');
        $router = service('router');
        $userAgent = $request->getUserAgent();
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];

        $logData = [
            'DATE' => date('Y-m-d'),
            'status' => $status,
            'message' => $message,
            'method' => $request->getMethod(),
            'routes_info' => $router->getMatchedRoute(),
            'route' => current_url(),
            'controller' => $trace['class'] ?? 'N.A',
            'function' => $trace['function'] ?? 'N.A',
            'ip_address' => $request->getIPAddress(),
            'user_agent' => $userAgent->getAgentString(),
            'timestamp' => date('Y-m-d H:i:s'),
            'body' => $extraData,
        ];

        $prettyJson = json_encode($logData, JSON_PRETTY_PRINT);

        $formattedLog = PHP_EOL
            . "================== START ==================" . PHP_EOL
            . $prettyJson . PHP_EOL
            . "================== END ====================" . PHP_EOL;

        $logPath = WRITEPATH . 'logs/custom/';
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }

        // Ensure .log extension if not present
        if (pathinfo($fileName, PATHINFO_EXTENSION) !== 'log') {
            $fileName .= '.log';
        }

        $file = $logPath . $fileName;
        file_put_contents($file, $formattedLog, FILE_APPEND);
    }
}
