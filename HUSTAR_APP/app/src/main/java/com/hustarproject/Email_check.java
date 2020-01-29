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

    public static int flag = -1;
    public static Email email;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_email_check);

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
                semail = email_write.getText().toString();

                email = new Email();
                email.execute();

                certificationCheck certificationCheck = new certificationCheck();
                certificationCheck.execute();
            }
        });
    }

    public class Email extends AsyncTask<String, Void, Void> {
        public String header;
        public String message;

        @Override
        protected Void doInBackground(String... strings) {
            Log.i("TEST", "이메일 전송 한다이");

            String loging = server_root + "/verify/1";
            HttpURLConnection conn = null;
            OutputStream os = null;
            InputStream is = null;
            ByteArrayOutputStream baos = null;

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

                    header = (String) responseJSON.get("header");
                    message = responseJSON.get("message").toString();
                }
                conn.disconnect();

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

            if(message != null){
                if (message.equals("0")) {
                    Toast.makeText(Email_check.this, "이메일을 확인해 주세요", Toast.LENGTH_SHORT).show();
                    flag = 0;
                    email.cancel(true);
                }else if(message.equals("1")) {
                    Toast.makeText(Email_check.this, "이미 Hustar 회원 입니다", Toast.LENGTH_SHORT).show();
                }else if(message.equals("2")){
                    Toast.makeText(Email_check.this, "이메일 전송에 실패하였습니다. \n다시 시도해주세요", Toast.LENGTH_SHORT).show();
                }else{
                    Toast.makeText(Email_check.this, "DB오류 \n다시 시도해주세요", Toast.LENGTH_SHORT).show();
                }
            }

        }
    }


    public class certificationCheck extends AsyncTask<String, Void, Void> {
        public String message;

        @Override
        protected Void doInBackground(String... strings) {
            email.cancel(true);

            String checkurl = server_root + "/verify/check/certification";
            HttpURLConnection connection = null;
            OutputStream outputStream = null;
            InputStream inputStream = null;
            ByteArrayOutputStream byteArrayOutputStream = null;

            while(isCancelled() == false) {
                try {
                    URL checkUrl = new URL(checkurl);

                    connection = (HttpURLConnection) checkUrl.openConnection();
                    connection.setRequestMethod("POST");
                    connection.setRequestProperty("Cache-Control", "no-cache");
                    connection.setRequestProperty("Content-Type", "application/json");
                    connection.setRequestProperty("Accept", "application/json");

                    connection.setDoOutput(true);
                    connection.setDoInput(true);

                    JSONObject job = new JSONObject();
                    job.put("EMAIL", semail);

                    outputStream = connection.getOutputStream();
                    outputStream.write(job.toString().getBytes());
                    outputStream.flush();
                    outputStream.close();

                    String response;
                    int responseCode = connection.getResponseCode();

                    if (responseCode == HttpURLConnection.HTTP_OK) {

                        inputStream = connection.getInputStream();
                        byteArrayOutputStream = new ByteArrayOutputStream();
                        byte[] byteBuffer = new byte[1024];
                        byte[] byteData = null;
                        int nLength = 0;
                        while ((nLength = inputStream.read(byteBuffer, 0, byteBuffer.length)) != -1) {
                            byteArrayOutputStream.write(byteBuffer, 0, nLength);
                        }
                        byteData = byteArrayOutputStream.toByteArray();

                        response = new String(byteData);
                        JSONObject responseJSON = new JSONObject(response);

                        String header = (String) responseJSON.get("header");
                        message = responseJSON.get("message").toString();
                    }

                    connection.disconnect();
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                if(message != null){
                    Log.i("test", message);
                    if(message.equals("0")){
                        Intent intent = new Intent(Email_check.this, Join.class);
                        intent.putExtra("string",semail);
                        Log.i("TAG",semail);
                        startActivity(intent);

                        this.cancel(true);
                    }
                }

            }
            return null;
        }
    }
}
