<?php
function main_public_path($path = '') {
    $public_path = public_path($path);
    $public_path = str_replace("vore.neuronsit.sg", "vorecentral.com", $public_path);
    return $public_path;
}
function main_asset_path($path = '') {
    $asset_path = asset($path);
    $asset_path = str_replace("vore.neuronsit.sg", "vorecentral.com", $asset_path);
    return $asset_path;
}

?>