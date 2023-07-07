<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('git_branch')) {
    function git_branch()
    {
        $gitBasePath = FCPATH . '../.git'; // e.g in laravel: base_path().'/.git';

        $gitStr = file_get_contents($gitBasePath . '/HEAD');
        $gitBranchName = rtrim(preg_replace("/(.*?\/){2}/", '', $gitStr));
        $gitPathBranch = $gitBasePath . '/refs/heads/' . $gitBranchName;
        $gitHash = file_get_contents($gitPathBranch);
        $gitDate = date(DATE_ATOM, filemtime($gitPathBranch));

        $format['version_date'] = $gitDate;
        $format['branch'] = $gitBranchName;
        $format['commit'] = $gitHash;                                                       

        return $format;

    }
}
