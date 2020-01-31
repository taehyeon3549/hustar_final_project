package com.hustarproject;

import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.OrientationHelper;

import com.applikeysolutions.cosmocalendar.view.CalendarView;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.List;


public class  Calendar_check extends AppCompatActivity{

        private CalendarView calendarView;

        @Override
        protected void onCreate(@Nullable Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_calendar_check);
            Log.d("test","캘린더");

            initViews();
        }
        private void initViews() {
            calendarView = (CalendarView) findViewById(R.id.calendar_view);
            calendarView.setCalendarOrientation(OrientationHelper.HORIZONTAL);

        }

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
            Toast.makeText(Calendar_check.this, result, Toast.LENGTH_LONG).show();
            return true;


        }

}
