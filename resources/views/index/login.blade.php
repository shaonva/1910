@extends('layouts.shop')
@section('title','登录')
@section('content')
  
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/doLogin')}}" method="post" class="reg-login">
     	@csrf
     	<input type="hidden" name="refer" value="{{request()->refer}}">
      <h3>还没有三级分销账号？点此<a class="orange" href="reg.html">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="admin_name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" name="pwd" placeholder="输入证码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="#btn" value="立即登录" />
      </div>
     </form><!--reg-login/-->
    
  @include('index.public.foot');  
  @endsection