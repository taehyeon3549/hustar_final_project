package com.hustarproject;

import androidx.appcompat.app.AppCompatActivity;

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

public class Join extends AppCompatActivity {
    EditText idText,password_Text,password_recheck_Text,user_name,edit_phone;
    Button Submit;
    String server_root = "http://54.180.159.207";
    String result = null;
    String sid,spw,sname,snum;

    HttpURLConnection conn = null;

    OutputStream os = null;
    InputStream is = null;
    ByteArrayOutputStream baos = null;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_join);

        Intent intent=getIntent();
        String receiveStr=intent.getExtras().getString("string");

        idText=(EditText)findViewById(R.id.idText);
        idText.setText(receiveStr);
        password_Text=(EditText)findViewById(R.id.password_Text);
        password_recheck_Text=(EditText)findViewById(R.id.password_recheck_Text);
        user_name=(EditText)findViewById(R.id.user_name);
        edit_phone=(EditText)findViewById(R.id.edit_phone);



        Submit=(Button)findViewById(R.id.Submit);
        Submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sid=idText.getText().toString();
                spw=password_Text.getText().toString();
                sname=user_name.getText().toString();
                snum=edit_phone.getText().toString();

                String Joining = server_root + "/signup";
                join join=new join();
                join.execute();

            }
        });
    }
    public class join extends AsyncTask<String, Void, Void> {

        public String messsage;

        @Override
        protected Void doInBackground(String... strings) {
            String loging = server_root + "/signup";

            try {
                URL url = new URL(loging);

                conn = (HttpURLConnection) url.openConnection();// ?????? ????????? ???????????? ????????? ??????, ?????? HTTP ????????? ???????????? ???????????????.
                conn.setRequestMethod("POST"); //POST???????????? ??????
                conn.setRequestProperty("Cache-Control", "no-cache");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setRequestProperty("Accept", "application/json");

                conn.setDoOutput(true);//OutputStream?????? POST ???????????? ?????????????????? ????????? ??????
                conn.setDoInput(true);//InputStream?????? ??????????????? ?????? ????????? ???????????? ????????????????????? ????????? ??????

                JSONObject job = new JSONObject();
                Log.i("TAG", sid);
                job.put("EMAIL", sid);
                job.put("PASSWORD", spw);
                job.put("PHONE", snum);
                job.put("NAME", sname);
//                job.put("GENDER", sid);
//                job.put("BIRTH", spw);

                os = conn.getOutputStream();// ????????? OutputStream??? ????????? OutputStream??? ?????????.
                // ????????? write???????????? ???????????? ????????? ????????????????????? ?????????????????? "EUC-KR"??? ??????????????? ????????????.
                // ????????? ????????? ?????? "UTF-8"??? ?????? ????????? ????????? ????????? "EUC-KR"??? ?????????????????? ????????? ????????? ????????????.
                os.write(job.toString().getBytes("euc-kr"));
                os.flush();// ???????????? ????????? ????????????.
                os.close();// ???????????? ?????????.

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
                    Log.i("TEST", "header ??? " + header + "message ???" + messsage);
                    result = "header ??? " + header + "message ???" + messsage;
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

            /*????????? ?????? ?????????*/
            switch (messsage) {
                case "0":
                    Log.i("TEST", "0");
                    Toast.makeText(getApplicationContext(), " ??????????????? ?????????????????????.", Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(Join.this, LOGIN.class);
                    Join.this.startActivity(intent);
                    break;
                case "1":
                    Log.i("TAG", "1");
                    Toast.makeText(getApplicationContext(), "???????????? ?????? \n????????? ?????? ??? ?????? ?????????.", Toast.LENGTH_SHORT).show();
                    break;
                case "2":
                    Log.i("TAG", "2");
                    Toast.makeText(Join.this, "DB?????? \n?????? ?????????????????? ", Toast.LENGTH_SHORT).show();
                    break;
            }
        }
    }

}
