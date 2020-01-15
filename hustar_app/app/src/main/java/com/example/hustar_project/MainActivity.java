package com.example.hustar_project;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button calenderButton=(Button)findViewById(R.id.calendarButton);

        calenderButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent calenderIntent=new Intent(MainActivity.this,Calendar.class);
                MainActivity.this.startActivity(calenderIntent);
            }
        });
    }
}
