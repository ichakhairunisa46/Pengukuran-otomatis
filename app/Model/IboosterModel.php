<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Makassar');

class IboosterModel extends Model
{
    public static function ukur_ibooster($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://kawan.tomman.app/api/ibooster_ukur?no_inet='.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $ibooster = json_decode($response);

        return $ibooster;
    }

    public static function log_ibooster($nd_inet, $type, $data)
    {
        DB::table('data_ibooster')->where([
            ['nd_inet', $nd_inet],
            ['data_type', $type]
        ])
        ->whereDate('created_date', date('Y-m-d'))
        ->delete();

        DB::table('data_ibooster')->insert([
            'nd_inet'           => $nd_inet,
            'nas_ip'            => @$data->nas_ip,
            'frame_ip'          => @$data->frame_ip,
            'clid'              => @$data->clid,
            'type'              => @$data->type,
            'shelf'             => @$data->shelf,
            'slot'              => @$data->slot,
            'port'              => @$data->port,
            'host_id'           => @$data->host_id,
            'hostname'          => @$data->hostname,
            'identifier'        => @$data->identifier,
            'description'       => @$data->description,
            'onu'               => @$data->onu,
            'vendor_id'         => @$data->vendor_id,
            'fiber_length'      => @$data->fiber_length,
            'version_id'        => @$data->version_id,
            'desc_name'         => @$data->desc_name,
            'reg_type'          => @$data->reg_type,
            'oper_status'       => @$data->oper_status,
            'admin_status'      => @$data->admin_status,
            'bw_up'             => @$data->bw_up,
            'bw_down'           => @$data->bw_down,
            'onu_pwr_spl'       => @$data->onu_pwr_spl,
            'onu_bias_curr'     => @$data->onu_bias_curr,
            'onu_temp'          => @$data->onu_temp,
            'onu_rx_pwr'        => @$data->onu_rx_pwr,
            'onu_tx_pwr'        => @$data->onu_tx_pwr,
            'olt_tx_pwr'        => @$data->olt_tx_pwr,
            'olt_rx_pwr'        => @$data->olt_rx_pwr,
            'olt_temp'          => @$data->olt_temp,
            'olt_pwr_spl'       => @$data->olt_pwr_spl,
            'olt_bias_curr'     => @$data->olt_bias_curr,
            'serial_number'     => @$data->serial_number,
            'indikasi'          => @$data->indikasi,
            'gangguan'          => @$data->gangguan,
            'desc'              => @$data->desc,
            'suggestion'        => @$data->suggestion,
            'status_cpe'        => @$data->status_cpe,
            'tipejaringan'      => @$data->tipejaringan,
            'status_koneksi'    => @$data->status_koneksi,
            'status_jaringan'   => @$data->status_jaringan,
            'usage_download'    => @$data->usage_download,
            'usage_upload'      => @$data->usage_upload,
            'session_start'     => date('Y-m-d H:i:s', strtotime(@$data->session_start)),
            'mac'               => @$data->mac,
            'traffic_graph_id'  => @$data->traffic_graph_id,
            'connection_status' => @$data->connection_status,
            'ip_ams'            => @$data->ip_ams,
            'log'               => @$data->log,
            'data_type'         => $type,
            'created_date'      => date('Y-m-d'),
            'created_time'      => date('H:i:s')
        ]);
    }

    public static function data_pelanggan()
    {
        return DB::table('data_pelanggan')->get();
    }

    public static function data_hasil_ukur($kategori)
    {
        return DB::table('data_pelanggan AS dp')
        ->leftJoin('data_ibooster AS di', 'dp.no_inet', '=', 'di.nd_inet')
        ->where([
            ['dp.kategori', $kategori],
            ['di.created_date', date('Y-m-d')]
        ])
        ->whereIn('di.oper_status', ['LOS', 'OFFLINE'])
        ->get();
    }
}
