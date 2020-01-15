package com.example.hustar_project;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Login extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        Button loginButton=(Button)findViewById(R.id.loginButton);
        TextView joinButton=(TextView)findViewById(R.id.joinButton);

        //회원가입 text 누르면 Join (회원가입) 화면으로 감
        joinButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent joinIntent=new Intent(Login.this,Join.class);
                Login.this.startActivity(joinIntent);
            }
        });

        //로그인 버튼 클릭 시 main 화면으로 감
        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent loginIntent=new Intent(Login.this,MainActivity.class);
                Login.this.startActivity(loginIntent);
            }
        });
    }
}
