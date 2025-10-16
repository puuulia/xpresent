<template>
<header :class="['header', { 'header--custom': $page.props.shared.route!='index' }]" class="mb-1">
    <div class="container">
    <div class="header__wrap">
        <div class="header__block">
        <button @click="isVisibleMobileMenu = true" class="header__burger">
            <span class="header__burger-line"></span>
            <span class="header__burger-line"></span>
            <span class="header__burger-line"></span>
        </button>
        <Link route="index" class="header__logo">
            <img src="/images/logo.svg" alt="" />
            <span>СпецРеализация</span>
        </Link>
        </div>
        <nav class="header__nav">
        <ul>
            <li><Link route="auctions.list">Аукционы</Link></li>
            <li><Link route="buyes.list">Прямые продажи</Link></li>
            <li><Link route="bargains.list">Публичные торги</Link></li>
            <li><Link route="info">Информация</Link></li>
            <li><Link route="about">О компании</Link></li>
            <li><Link route="contacts">Контакты</Link></li>
        </ul>
        </nav>
        <div class="header__control">
        <Link route="login" as="button" class="header__button" v-if="!$page.props.shared.user">Вход</Link>
        <template v-else>
            <Link route="profile.settings" as="button" class="header__button">Профиль</Link>
            <ul class="header__dropdown">
                <li>
                    <Link route="profile.settings">Мой профиль</Link>
                </li>
                <li>
                    <Link route="profile.auctions">Мои аукционы</Link>
                </li>
                <li>
                    <Link route="profile.password">Настройка пароля</Link>
                </li>
                <li>
                    <Link route="profile.notifications">Уведомления</Link>
                </li>
                <li>
                    <Link method="post" route="logout">Выход</Link>
                </li>
            </ul>
        </template>
        </div>
    </div>
    </div>
</header>
<template v-if="$page.props.shared.user && $page.props.shared.user.admin">
    <div class="admin-button">
        <a :href="$route('filament.admin.pages.dashboard')"><span class="has-new" v-if="$page.props.shared.admin.has_new"></span> Админ-панель</a>
    </div>
</template>
<div @click="isVisibleMobileMenu = false" v-if="isVisibleMobileMenu" class="overlay"></div>
<div v-if="isVisibleMobileMenu" :class="['menu', { 'menu--custom': $route().current('index') }]">
    <div class="menu__wrap">
    <button @click="isVisibleMobileMenu = false" class="menu__close">
        <SvgComponent name="menu-close" />
    </button>
    <nav class="menu__nav">
        <ul>
            <li @click="isVisibleMobileMenu = false"><Link route="auctions.list">Аукционы</Link></li>
            <li @click="isVisibleMobileMenu = false"><Link route="buyes.list">Прямые продажи</Link></li>
            <li @click="isVisibleMobileMenu = false"><Link route="bargains.list">Публичные торги</Link></li>
            <li @click="isVisibleMobileMenu = false"><Link route="info">Информация</Link></li>
            <li @click="isVisibleMobileMenu = false"><Link route="about">О компании</Link></li>
            <li @click="isVisibleMobileMenu = false"><Link route="contacts">Контакты</Link></li>
        </ul>
    </nav>
    </div>
</div>
</template>

<script setup>
import { ref } from "vue";
import Link from '@/components/Link.vue'
const isVisibleMobileMenu = ref(false);
import SvgComponent from "@/components/UI/SvgComponent.vue"
</script>

<style scoped>
.admin-button {
    position: fixed;
    top: 0;
    z-index: 9999;
    right: 0;
    padding: 0.5rem;
    border-radius: 0 0 0 1rem;
    background: #e8e8e8;
}

.admin-button .has-new {
    padding: 0.3rem;
    background: orange;
    border-radius: 10rem;
    display: inline-block;
}
.menu__nav a {
padding: 10px 20px;
display: block;
color: #000;
font-size: 18px;
font-style: normal;
font-weight: 500;
line-height: normal;
}
.menu__nav a.active {
color: #fff;
background: linear-gradient(90deg, #32a9bb 0%, #0e7284 100%);
opacity: 1;
}
.menu__wrap {
padding: 13px 0 15px 0;
}
.menu__close {
margin-left: 10px;
padding: 14px;
margin-bottom: 5px;
}
.menu {
display: none;
position: fixed;
top: 0;
height: 100%;
bottom: 0;
width: 241px;
background-color: #fff;
z-index: 100;
}
.menu.menu--custom {
top: 200px;
}
.overlay {
display: none;
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
width: 100vw;
height: 100vh;
z-index: 99;
background-color: #000;
opacity: 0.2;
}
.header__burger {
display: none;
}
.header__nav ul {
display: flex;
align-items: center;
column-gap: 30px;
}
.header__wrap {
position: relative;
padding: 31px 0;
display: grid;
grid-template-columns: repeat(2, minmax(0, max-content));
column-gap: 108px;
border-bottom: 1px solid #cacaca;
}
.header--custom .header__wrap {
border-bottom: none;
}
.header__control {
top: 22px;
position: absolute;
right: 0;
}
.header__nav {
align-self: center;
}
.header__nav a {
color: #000;
font-size: 18px;
font-style: normal;
font-weight: 500;
line-height: normal;
}

.header__nav a.active {
color: #32a9bb;
opacity: 1;
}

.header__button {
padding: 0px 50px;
border-radius: 10px;
background: linear-gradient(90deg, #32a9bb 0%, #0e7284 100%), linear-gradient(90deg, #32a9bb 0.04%, #0f6 122.17%),
    #32a9bb;
color: #fff;
font-size: 18px;
font-style: normal;
font-weight: 500;
line-height: normal;
height: 68px;
}

.header__control:hover > .header__dropdown {
display: flex;
}

.header__control > .header__dropdown {
width: 229px;
padding: 20px 30px;
flex-direction: column;
align-items: flex-start;
gap: 15px;
border-radius: 10px;
background: var(--light-blue, #9CBDC1);
position: absolute;
right: 0;
margin-top: 5px;
display: none;
z-index: 9;
}

.header__dropdown > li.active > a,
.header__dropdown > li:hover > a,
.header__dropdown > li > a.active {
color: #38595D;
cursor: pointer;
}

.header__dropdown > li > a {
color: var(--wight, #FFF);
font-family: Raleway;
font-size: 16px;
font-style: normal;
font-weight: 400;
line-height: 130%;
}

.header__logo {
display: flex;
align-items: center;
column-gap: 11px;
opacity: 1;
}
.header__logo img {
width: 52px;
height: 50px;
object-fit: scale-down;
}
.header__logo span {
color: #3db4c6;
font-family: "Raleway";
font-size: 28px;
font-style: normal;
font-weight: 700;
line-height: normal;
}
@media (max-width: 1650px) {
.header__wrap {
    column-gap: 40px;
}
.header__nav ul {
    column-gap: 15px;
}
}
@media (max-width: 1460px) {
.header__control {
    top: 19px;
}
.header__wrap {
    grid-template-columns: 1fr;
    row-gap: 32px;
    padding: 28px 0 17px 0;
}
.header__nav ul {
    justify-content: space-between;
}
}
@media (max-width: 1100px) {
.menu.menu--custom {
    top: 158px;
}
.header__control {
    top: 13px;
}
.header__wrap {
    grid-template-columns: 1fr;
    padding: 22px 0 16px 0;
}
}
@media (max-width: 990px) {
.overlay,
.menu {
    display: block;
}
.menu.menu--custom {
    top: 118px;
}
.header__block {
    display: flex;
    align-items: center;
    column-gap: 25px;
}
.header__burger {
    padding: 0;
    width: 20px;
    height: 14px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.header__burger-line {
    display: block;
    width: 100%;
    height: 2px;
    background-color: #000;
}
.header__logo {
    column-gap: 14px;
}
.header__logo img {
    width: 41px;
    height: 44px;
}
.header__logo span {
    font-size: 24px;
}
.header__wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
}
.header__control {
    position: static;
}
.header__button {
    font-size: 16px;
    height: 51px;
}

.header__nav {
    display: none;
}
}
@media (max-width: 767px) {
.menu.menu--custom {
    top: 88px;
}
.header__wrap {
    padding: 21px 0 19px 0;
    column-gap: 0;
    border-bottom: none;
}
.header__button {
    font-size: 14px;
    padding: 0;
    width: 85px;
    height: 28px;
}
.header__logo img {
    width: 17px;
    height: 17px;
}
.header__logo {
    column-gap: 5px;
}
.header__logo span {
    font-size: 13px;
}
}
</style>
