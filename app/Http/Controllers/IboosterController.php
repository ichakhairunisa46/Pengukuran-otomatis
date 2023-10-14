<?php

namespace App\Http\Controllers;

use App\Model\IboosterModel;

date_default_timezone_set('Asia/Makassar');

class IboosterController extends Controller
{
    public static function dashboard()
    {
        $data_hvc   = IboosterModel::data_hasil_ukur('HVC');
        $data_sugar = IboosterModel::data_hasil_ukur('SUGAR');

        return view('ibooster.dashboard', compact('data_hvc', 'data_sugar'));
    }

    public static function ukur_all()
    {
        $data = IboosterModel::data_pelanggan();

        $total = count($data);

        print_r("\nmulai pengukuran ibooster dengan total $total\n\n");

        foreach ($data as $k => $v)
        {
            $ibooster = IboosterModel::ukur_ibooster($v->no_inet);

            if ($ibooster != null)
            {
                if (empty($ibooster->MESSAGE))
                {
                    if (!empty($ibooster->onu_rx_pwr) && !empty($ibooster->oper_status))
                    {
                        $numb = ++$k;

                        // menambahkan log untuk menyimpan data hasil ukur ibooster
                        IboosterModel::log_ibooster($v->no_inet, $v->kategori, $ibooster);

                        if ($ibooster->onu_rx_pwr != 'null')
                        {
                            $onu_rx_pwr = $ibooster->onu_rx_pwr;
                        }

                        if (in_array($ibooster->oper_status, ['LOS','OFFLINE']))
                        {
                            $status_connection = $ibooster->oper_status;
                        }
                        else if (in_array($onu_rx_pwr, ['-', '-99', '-500']))
                        {
                            $status_connection = 'LOS';
                        }
                        else if ($ibooster->oper_status == 'ONLINE' && $ibooster->connection_status == 'Stop')
                        {
                            $status_connection = 'ONLINE-STOP';
                        }
                        else if ($onu_rx_pwr < '-26')
                        {
                            $status_connection = 'UNSPEC < -26';
                        }
                        else
                        {
                            $status_connection = $onu_rx_pwr;
                        }

                        print_r("#$numb | $v->no_inet | $v->sto | $status_connection | $v->kategori\n");
                    }
                }
            }
        }

        // mengulang pengukuran dari awal
        self::ukur_all();
    }
}
