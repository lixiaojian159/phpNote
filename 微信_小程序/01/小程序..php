<?php

/**

一.小程序原理
   
   静态小程序和动态小程序

   详细解说： 动态小程序

   1. 后端：内容后台 

      开发调试工具

      前端：小程序


二、 小程序配置选项

微信小程序使用   app.json  (client/vendor/app.json)  文件来对微信小程序进行全局配置，决定页面的路径、窗口表现、设置网络超时时间、设置多tab等


{
  "pages":[
    "pages/index/index",
    "pages/addCgi/addCgi"
  ],
  "window":{
    "backgroundColor":"#ff8ac0",
    "backgroundTextStyle":"light",
    "navigationBarBackgroundColor": "#F6F6F6",
    "navigationBarTitleText": "WafeStart",
    "navigationBarTextStyle":"black"
  }
}


三、 小程序的开发工具


四、 小程序的框架

    目录结构 

    配置  app.json  注意：app.json  和每个页面下面的*.json 必须设置配置 {}

    逻辑层

    视图层   数据绑定


    组件  view image



