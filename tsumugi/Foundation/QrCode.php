<?php

namespace tsumugi\Foundation;

use SimpleSoftwareIO\QrCode\Facades\QrCode as SimpleQrCode;

class QrCode
{
    public function generate($payload)
    {
        return SimpleQrCode::generate($payload);
    }
}
