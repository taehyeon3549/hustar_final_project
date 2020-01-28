package com.hustarproject;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.Dialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;


import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;


public class Email_check extends AppCompatActivity {
    String server_root = "http://54.180.159.207";
    String result = null;
    String semail;
    EditText email_write;
    Button email_send_but;

    HttpURLConnection conn = null;

    OutputStream os = null;
    InputStream is = null;
    ByteArrayOutputStream baos = null;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_email_check);

        /*ForeGroundService start*/


        Dialog dialog = new Dialog(this);
        dialog.setContentView(R.layout.auth_dialog);
        //툴바 설정
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setTitle(R.string.Email_Title);
        setSupportActionBar(toolbar);

        email_write = (EditText) findViewById(R.id.email_text);
        email_send_but = (Button) findViewById(R.id.email_send_button);
        email_send_but.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                semail=email_write.getText().toString();
                Email email = new Email();
                email.execute();
            }
        });
    }

    public class Email extends AsyncTask<String, Void, Void> {
        public String messsage;
        @Override
        protected Void doInBackground(String... strings) {
            String loging = server_root + "/verify/1";

            try {
                URL url = new URL(loging);

                conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Cache-Control", "no-cache");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setRequestProperty("Accept", "application/json");

                conn.setDoOutput(true);
                conn.setDoInput(true);

                JSONObject job = new JSONObject();
                Log.i("TAG", semail);
                job.put("EMAIL", semail);

                os = conn.getOutputStream();
                os.write(job.toString().getBytes());
                os.flush();
                os.close();

                String response;
                int responseCode = conn.getResponseCode();

                if (responseCode == HttpURLConnection.HTTP_OK) {

                    is = conn.getInputStream();
                    baos = new ByteArrayOutputStream();
                    byte[] byteBuffer = new byte[1024];
                    byte[] byteData = null;
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
                    Log.i("TAG","0");
                    Toast.makeText(getApplicationContext(), "메일을 전송하였습니다. 확인해 주세요", Toast.LENGTH_SHORT).show();
                    break;
                case "1":
                    Log.i("TAG","1");
                    Toast.makeText(getApplicationContext(), "이미 등록된 메일 입니다.", Toast.LENGTH_SHORT).show();
                    break;
                case "2":
                    Log.i("TAG","2");
                    Toast.makeText(Email_check.this, "이메일 전송에 실패하였습니다.", Toast.LENGTH_SHORT).show();
                    break;
                case "3":
                    Log.i("TAG","3");
                    Toast.makeText(Email_check.this, "이메일 전송에 실패하였습니다.", Toast.LENGTH_SHORT).show();
                    break;
                case "4":
                    Log.i("TAG","4");
                    Toast.makeText(Email_check.this, "이메일 전송에 실패하였습니다.", Toast.LENGTH_SHORT).show();
                    break;
            }
        }
    }

}
