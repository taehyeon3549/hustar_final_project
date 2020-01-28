package com.example.myapplication;


import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.OrientationHelper;

import com.applikeysolutions.cosmocalendar.view.CalendarView;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.List;


public class Calendar_check extends AppCompatActivity {

    private CalendarView calendarView;


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_calendar_check);
        Log.d("test","캘린더");
        //툴바 설정
        Toolbar toolbar = (Toolbar)findViewById(R.id.toolbar);
        toolbar.setTitle(R.string.Calendar_Title);
        setSupportActionBar(toolbar);
        //캘린더 함수 호출
        initViews();
    }

    //캘린터 이미지 표시
    private void initViews() {
        calendarView = (CalendarView) findViewById(R.id.calendar_view);
        calendarView.setCalendarOrientation(OrientationHelper.HORIZONTAL);
    }

    //캘린더 날짜 및 메시지 표시
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        List<Calendar> days = calendarView.getSelectedDates();
        String result="";
        for( int i=0; i<days.size(); i++)
        {
            Calendar calendar = days.get(i);
            final int day = calendar.get(Calendar.DAY_OF_MONTH);
            final int month = calendar.get(Calendar.MONTH);
            final int year = calendar.get(Calendar.YEAR);
            String week = new SimpleDateFormat("EE").format(calendar.getTime());
            String day_full = year + "년 "+ (month+1)  + "월 " + day + "일 " + week + "요일";
            result += (day_full + "\n");
        }
        return true;
    }

}
