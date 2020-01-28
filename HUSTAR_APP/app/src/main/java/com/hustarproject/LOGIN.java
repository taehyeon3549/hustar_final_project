package com.hustarproject;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;

public class LOGIN extends AppCompatActivity {
    EditText idText, passwordText;
    TextView new_join;
    Button login_Button;
    String server_root = "http://54.180.159.207";
    String result = null;
    String sid, spw;

    HttpURLConnection conn = null;

    OutputStream os = null;
    InputStream is = null;
    ByteArrayOutputStream baos = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        idText = (EditText) findViewById(R.id.idText);
        passwordText = (EditText) findViewById(R.id.passwordText);
        login_Button = (Button) findViewById(R.id.login_Button);
        new_join = (TextView) findViewById(R.id.new_join);
        startService();

        /*서비스 연결*/
//        if (RealService.serviceIntent == null) {
//            serviceIntent = new Intent(this, RealService.class);
//            startService(serviceIntent);
//        } else {
//            serviceIntent = RealService.serviceIntent;//getInstance().getApplication();
//            Toast.makeText(getApplicationContext(), "already", Toast.LENGTH_LONG).show();
//        }

        new_join.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent joinIntent = new Intent(LOGIN.this, Email_check.class);
                LOGIN.this.startActivity(joinIntent);

            }
        });

        login_Button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sid = idText.getText().toString();
                spw = passwordText.getText().toString();
                login login = new login();
                login.execute();
            }
        });
    }


    public class login extends AsyncTask<String, Void, Void> {

        public String messsage;

        @Override
        protected Void doInBackground(String... strings) {
            String loging = server_root + "/signin";

            try {
                URL url = new URL(loging);

                conn = (HttpURLConnection) url.openConnection();// 해당 주소의 페이지로 접속을 하고, 단일 HTTP 접속을 하기위해 캐스트한다.
                conn.setRequestMethod("POST"); //POST방식으로 요청
                conn.setRequestProperty("Cache-Control", "no-cache");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setRequestProperty("Accept", "application/json");

                conn.setDoOutput(true);//OutputStream으로 POST 데이터를 넘겨주겠다는 옵션을 정의
                conn.setDoInput(true);//InputStream으로 서버로부터 응답 헤더와 메시지를 읽어들이겠다는 옴셥을 정의

                JSONObject job = new JSONObject();
                Log.i("TAG", sid);
                job.put("EMAIL", sid);
                job.put("PASSWORD", spw);

                os = conn.getOutputStream();// 새로운 OutputStream에 요청할 OutputStream을 넣는다.
                // 그리고 write메소드로 메시지로 작성된 파라미터정보를 바이트단위로 "EUC-KR"로 인코딩해서 요청한다.
                // 여기서 중요한 점은 "UTF-8"로 해도 되는데 한글일 경우는 "EUC-KR"로 인코딩해야만 한글이 제대로 전달된다.
                os.write(job.toString().getBytes("euc-kr"));
                os.flush();// 스트림의 버퍼를 비워준다.
                os.close();// 스트림을 닫는다.

                String response;
                int responseCode = conn.getResponseCode();

                if (responseCode == HttpURLConnection.HTTP_OK) {

                    is = conn.getInputStream();
                    baos = new ByteArrayOutputStream();
                    byte[] byteBuffer = new byte[1024];
                    byte[] byteData;
                    int nLength = 0;
                    while ((nLength = is.read(byteBuffer, 0, byteBuffer.length)) != -1) {
                        baos.write(byteBuffer, 0, nLength);
                    }
                    byteData = baos.toByteArray();

                    response = new String(byteData);

                    JSONObject responseJSON = new JSONObject(response);

                    String header = (String) responseJSON.get("header");
                    messsage = responseJSON.get("message").toString();
                    Log.i("TEST", "header 는 " + header + "message 는" + messsage);
                    result = "header 는 " + header + "message 는" + messsage;
                    Log.i("TAG", "DATA response = " + response);
                }
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);

            /*결과에 따른 이벤트*/
            switch (messsage) {
                case "0":
                    Log.i("TEST", "0");
                    Intent intent = new Intent(LOGIN.this, MainActivity.class);
                    LOGIN.this.startActivity(intent);
                    break;
                case "1":
                    Log.i("TAG", "1");
                    Toast.makeText(getApplicationContext(), "Password가 틀렸습니다.", Toast.LENGTH_SHORT).show();
                    break;
                case "2":
                    Log.i("TAG", "2");
                    Toast.makeText(LOGIN.this, "정보를 입력해 주세요.", Toast.LENGTH_SHORT).show();
                    break;
            }
        }
    }
    public void startService() {
        Intent serviceIntent = new Intent(this, ForgroundService.class);
        serviceIntent.putExtra("inputExtra", "Foreground Service Example in Android");
        ContextCompat.startForegroundService(this, serviceIntent);
    }
}
