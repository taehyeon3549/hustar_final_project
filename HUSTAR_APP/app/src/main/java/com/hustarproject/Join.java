package com.hustarproject;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import java.io.ByteArrayOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;

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

        idText=(EditText)findViewById(R.id.idText);
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

                String loging = server_root + "/signup";

            }
        });
    }

}
