package com.hustarproject;

import android.app.Activity;
import android.app.ListActivity;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.bluetooth.BluetoothGatt;
import android.bluetooth.BluetoothGattCallback;
import android.bluetooth.BluetoothManager;
import android.bluetooth.BluetoothProfile;
import android.bluetooth.le.BluetoothLeScanner;
import android.bluetooth.le.ScanCallback;
import android.bluetooth.le.ScanResult;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.provider.Settings;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;
import java.util.logging.Handler;
import java.util.logging.LogRecord;

import static android.Manifest.permission.ACCESS_COARSE_LOCATION;

public class DeviceScanActivity extends AppCompatActivity {
    boolean scanning = false;
    public int condition_flag = 0;

    private BluetoothManager bluetoothManager;
    //블루투스 매니저
    //블루트스 기능을 총괄적으로 관리함.
    private BluetoothAdapter bluetoothAdapter;
    private BluetoothLeScanner bluetoothLeScanner;


    /**
     * 블루투스 콜백
     **/
    private final BluetoothGattCallback bluetoothGattCallback = new BluetoothGattCallback() {
        @Override
        public void onConnectionStateChange(BluetoothGatt gatt, int status, int newState) {
            super.onConnectionStateChange(gatt, status, newState);
            switch (newState) {
                case BluetoothProfile.STATE_CONNECTED:
                    Log.e("TEST", "gattCallback >> STATE_CONNECTED");
                    gatt.discoverServices();
                    Toast.makeText(DeviceScanActivity.this, "bluetooth connected", Toast.LENGTH_SHORT).show();
                    condition_flag = 1;
                    break;
                case BluetoothProfile.STATE_DISCONNECTED:
                    Log.e("TEST", "gattCallback >> STATE_DISCONNECTED");
                    bluetoothLeScanner.startScan(scanCallback);
                    condition_flag = 0;
                    break;
                default:
                    Log.e("TEST", "gattCallback >> STATE_OTHER");
            }
        }
    };

    private ScanCallback scanCallback = new ScanCallback() {
        @Override
        public void onScanFailed(int errorCode) {
            super.onScanFailed(errorCode);
            Log.d("결과 ", "onScanFailed: ");
        }


        @Override
        public void onScanResult(int callbackType, ScanResult result) {
            super.onScanResult(callbackType, result);
            String deviceName = result.getDevice().getName();
            String deviceAddress = result.getDevice().getAddress();
            Log.i("test", deviceAddress);

            if (deviceName != null) {
                Log.i("test", deviceName);
            }

            if ("My Home".equals(deviceName)) {
                if ("84:0D:8E:19:D7:56".equals(deviceAddress)) {
                    bluetoothLeScanner.stopScan(scanCallback);
                    Log.d("test", "찾았다");
                    result.getDevice().connectGatt(DeviceScanActivity.this, true, bluetoothGattCallback);
                }
            }
        }
    };


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        String android_id = Settings.Secure.getString(getApplicationContext().getContentResolver(), Settings.Secure.ANDROID_ID);
        Log.d("android_id", android_id);

        Log.d("test", "Bluetooth.java onCreate");
        bluetoothManager = (BluetoothManager) getSystemService(Context.BLUETOOTH_SERVICE);
        bluetoothAdapter = bluetoothManager.getAdapter();
        bluetoothLeScanner = bluetoothAdapter.getBluetoothLeScanner();

        bluetoothLeScanner.startScan(scanCallback);
    }

    @Override
    protected void onStart() {
        super.onStart();
        Log.d("test", "Bluetooth.java onStart");
        if (!bluetoothAdapter.isEnabled()) {
            if (!bluetoothAdapter.isEnabled()) {
                Intent enableBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
                startActivityForResult(enableBtIntent, 1000);
            }
        }

        if (checkSelfPermission(ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            requestPermissions(new String[]{ACCESS_COARSE_LOCATION}, 1001);
        }


    }

    @Override
    protected void onResume() {
        super.onResume();
    }
}
//    private LeDeviceListAdapter mLeDeviceListAdapter;//스캔 리스트 어댑터
//    private BluetoothAdapter mBluetoothAdapter;//블루투스 어댑터
//    private  boolean mScanning;//스캐닝 확인 값
//    private Handler mHandler;//handler
//
//    private static final int REQUEST_ENABLE_BT=1;
//    //Stops scanning after 10 seconds.
//    private static final int SCAN_PERIOD=10000;//스캔 주기
//
//    @Override
//    protected void onCreate(@Nullable Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//        getActionBar().setTitle("BLE Scan");
//        mHandler=new Handler();//핸들러 객체 생성
//
//        //블루투스가 BLE를 지원하는 지 검사하는 로직
//        if (!getPackageManager().hasSystemFeature(PackageManager.FEATURE_BLUETOOTH_LE)){
//            Toast.makeText(this,"BLE is not supported",Toast.LENGTH_SHORT).show();
//            finish();
//        }
//        //블루투스 어댑터 생성. api18이상 가능
//        final BluetoothManager bluetoothManager=(BluetoothManager) getSystemService(Context.BLUETOOTH_SERVICE);
//        if (bluetoothManager!=null){
//            mBluetoothAdapter=bluetoothManager.getAdapter();
//        }
//
//        //checks if Bluetooth is supported on the device
//        if (mBluetoothAdapter==null){
//            Toast.makeText(this,"Bluetooth not supported",Toast.LENGTH_SHORT).show();
//            finish();
//        }
//    }
//
//    @Override
//    protected void onResume() {
//        super.onResume();
//
//        //블루투스가 사용가능 상태인지 체크하고 아니라면 그 기능을 키도록 함
//        if (!mBluetoothAdapter.isEnabled()){
//            Intent enableBtIntent=new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
//            startActivityForResult(enableBtIntent,REQUEST_ENABLE_BT);//두번째 인자는 어떤 요청인지 구분하기 위해 적음
//        }
//
//        //Initializes list view adapter
//        //list view adapter를 생성
//        mLeDeviceListAdapter=new LeDeviceListAdapter();
//        setListAdapter(mLeDeviceListAdapter);
//        scanLeDevice(true);
//    }
//    @Override
//    protected void onActivityResult(int requestCode,int resultCode,Intent data){//블루투스 사용 허용 다이얼로그 결과
//        super.onActivityResult(requestCode,resultCode,data);
//
//        //User chose not to enable Bluetooth
//        if (requestCode==REQUEST_ENABLE_BT && resultCode== Activity.RESULT_CANCELED){
//            finish();
//            return;
//        }
//    }
//
//    private class LeDeviceListAdapter extends BaseAdapter{
//        private ArrayList<BluetoothDevice> mLeDevices;
//        private LayoutInflater mInflator;
//
//        public LeDeviceListAdapter(){
//            super();
//            mLeDevices=new ArrayList<BluetoothDevice>();
//            mInflator=DeviceScanActivity.this.getLayoutInflater();
//        }
//
//        public void addDevice(BluetoothDevice device){
//            if (!mLeDevices.contains(device)){
//                mLeDevices.add(device);
//            }
//        }
//
//        public BluetoothDevice getDevice(int position) {return mLeDevices.get(position);}
//        public void clear(){mLeDevices.clear();}
//
//        @Override
//        public int getCount(){return mLeDevices.size();}
//        @Override
//        public Object getItem(int i){return mLeDevices.get(i);}
//        @Override
//        public long getItemId(int i){return i;}
//    }
//
//    private  void scanLeDevice(final boolean enable){
//        if (enable){
//            //스캔 주기가 지나면 스캔을 그만두게함
//            mHandler.postDelayed(new Runnable() {
//                    mScanning = false;
//                    mBluetoothAdapter.stopLeScan(mLeScanCallback);
//                    invalodateOptionsMenu();//onCreateOptionsMenu 메소드를 다시 호출함
//                }, SCAN_PERIOD);
//                //스캔시작
//                 mScanning=true;
//                 mBluetoothAdapter.startLeScan(mLeScanCallback);
//        }else {
//            //스캔을 멈춤
//            mScanning=false;
//            mBluetoothAdapter.stopLeScan(mLeScanCallback);
//        }
//        invalodateOptionsMenu();
//    }
//
//    private BluetoothAdapter.LeScanCallback mLeScanCallback=new BluetoothAdapter.LeScanCallback() {
//        @Override
//        public void onLeScan(final BluetoothDevice device, int rssi, byte[] scanRecord) {
//            runOnUiThread(new Runnable() {
//                @Override
//                public void run() {
//                    mLeDeviceListAdapter.addDevice(device);
//                    mLeDeviceListAdapter.notifyDataSetChanged();
//                }
//            });
//        }
//    };
//

//}