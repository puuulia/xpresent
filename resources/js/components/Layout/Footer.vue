<script setup>
import SvgComponent from "@/components/UI/SvgComponent.vue"
import Link from '@/components/Link.vue'
</script>

<template>
<footer class="footer">
    <div class="container">
    <div class="footer__top">
        <ul class="footer__top-list footer__top-list--custom">
        <li><Link route="auctions.list">Аукционы</Link></li>
        <li><Link route="auctions.list" :data="{category: 4}">Легковые автомобили</Link></li>
        <li><Link route="auctions.list" :data="{category: 3}">Грузовые автомобили</Link></li>
        <li><Link route="auctions.list" :data="{category: 7}">Прицепы, полуприцепы</Link></li>
        <li><Link route="auctions.list" :data="{category: 8}">Специальная с/х техника</Link></li>
        </ul>
        <ul class="footer__top-list footer__top-list--wrap">
        <li><Link route="auctions.list" :data="{category: 1}">Автобусы, микроавтобусы</Link></li>
        <li><Link route="auctions.list" :data="{category: 2}">Автозапчасти</Link></li>
        <li><Link route="auctions.list" :data="{category: 6}">Недвижимость</Link></li>
        <li><Link route="auctions.list" :data="{category: 9}">Станки, оборудование</Link></li>
        <li><Link route="auctions.list" :data="{category: 11}">Стройматериалы</Link></li>
        </ul>
        <ul class="footer__top-list">
        <li><Link route="auctions.list" :data="{category: 10}">Строительные бытовки</Link></li>
        <li><Link route="auctions.list" :data="{category: 12}">Оргтехника</Link></li>
        <li><Link route="auctions.list" :data="{category: 5}">Мебель, мебельная фурнитура</Link></li>
        <li><Link route="auctions.list" :data="{category: 14}">Товары народного потребления</Link></li>
        <li><Link route="auctions.list" :data="{category: 13}">Животные</Link></li>
        </ul>
        <nav class="footer__top-nav">
        <ul>
            <li><Link route="buyes.list">Прямые продажи</Link></li>
            <li><Link route="bargains.list">Публичные торги</Link></li>
            <li><Link route="about">О компании</Link></li>
            <li><Link route="info">Информация</Link></li>
            <li><Link route="contacts">Контакты</Link></li>
        </ul>
        </nav>
    </div>
    <div class="footer__bottom">
        <div class="footer__bottom-info">
        <a :href="'/storage/' + $page.props.shared.user_agreement" target="_blank">Пользовательское соглашение сайта</a>
        <a :href="'/storage/' + $page.props.shared.reglament" target="_blank">Регламент организации электронных торгов</a>
        <p v-html="$page.props.shared.footer_text"></p>
        </div>
        <div class="footer__bottom-social">
        <a class="footer__bottom-phone" href="tel:+375 29 684-71-76">+375 29 684-71-76</a>
        <div class="footer__social">
            <a :href="$page.props.shared.socials.instagram"> <SvgComponent name="instagram" /> </a>
            <a :href="$page.props.shared.socials.facebook"> <SvgComponent name="facebook" /> </a>
            <a :href="$page.props.shared.socials.telegram"> <SvgComponent name="teleg" /> </a>
            <a :href="$page.props.shared.socials.whatsapp"> <SvgComponent name="whats" /> </a>
            <a :href="$page.props.shared.socials.viber"> <SvgComponent name="viber" /> </a>
        </div>
        <div class="footer__dev">
            <span>Разработка и продвижение:</span>
            <a href="https://voloshin.by"><SvgComponent name="logo-voloshin" /></a>
        </div>
        </div>
    </div>
    <div class="footer__info">
        <span>Copyright 2023</span>
    </div>
    </div>
</footer>
</template>

<style scoped>
.footer__bottom-social {
display: flex;
flex-direction: column;
align-items: flex-end;
}
.footer__bottom-phone {
display: block;
color: #393939;
font-variant-numeric: lining-nums proportional-nums;
font-family: "Raleway";
font-size: 26px;
font-style: normal;
font-weight: 400;
line-height: normal;
margin-bottom: 28px;
}
.footer__social {
display: flex;
align-items: center;
column-gap: 15px;
margin-bottom: 28px;
}
.footer__dev {
display: flex;
align-items: center;
column-gap: 10px;
}
.footer__dev span {
display: block;
margin-top: 3px;
color: #393939;
font-family: "Raleway";
font-size: 11px;
font-style: normal;
font-weight: 400;
line-height: 20px;
}
.footer__social a {
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
width: 40px;
height: 40px;
border-radius: 50%;
background-color: #393939;
}
.footer__bottom {
display: grid;
grid-template-columns: 1fr minmax(0, 303px);
column-gap: 105px;
}
.footer__bottom-info {
display: grid;
row-gap: 20px;
}
.footer__bottom-info a {
color: #32a9bb;
font-family: "Raleway";
font-size: 14px;
font-style: normal;
font-weight: 400;
line-height: 130%;
text-decoration: underline;
}
.footer__bottom-info p {
color: #393939;
font-variant-numeric: lining-nums proportional-nums;
font-family: "Raleway";
font-size: 14px;
font-style: normal;
font-weight: 500;
line-height: 190%;
}
.footer__info span {
color: #393939;
font-family: "Raleway";
font-variant-numeric: lining-nums proportional-nums;
font-size: 14px;
font-style: normal;
font-weight: 400;
line-height: normal;
letter-spacing: 0.84px;
}
.footer__top-list,
.footer__top-nav ul {
display: grid;
row-gap: 20px;
font-family: "Raleway";
font-size: 16px;
font-style: normal;
font-weight: 400;
line-height: normal;
}
.footer__top-list a,
.footer__top-nav ul a {
color: #393939;
}
.footer__top-list:first-child li:first-child a,
.footer__top-nav ul a {
font-weight: 600;
}
.footer__top {
display: grid;
grid-template-columns: repeat(4, 1fr);
padding: 30px 0;
border-top: 1px solid #cacaca;
border-bottom: 1px solid #cacaca;
column-gap: 20px;
}
.footer__top-block {
grid-column: 1 / 4;
}
.footer__top-category {
display: flex;
justify-content: space-between;
}
.footer__bottom {
padding: 20px 0;
border-bottom: 1px solid #cacaca;
}
.footer__info {
padding-top: 20px;
padding-bottom: 27px;
}
@media (max-width: 1023px) {
.footer__bottom {
    grid-template-columns: 1fr;
    row-gap: 20px;
}
.footer__bottom-social {
    order: -1;
    align-items: flex-start;
}
.footer__top {
    column-gap: 30px;
    grid-template-columns: repeat(3, 1fr);
}
.footer__top-list--wrap {
    grid-column: 1/2;
    grid-row: 2/3;
    padding-top: 20px;
}
.footer__top-nav {
    grid-column: 3/4;
}
}
@media (max-width: 767px) {
.footer__bottom-info a,
.footer__bottom-info p,
.footer__dev span {
    font-size: 10px;
}
.footer__bottom-phone {
    margin-bottom: 10px;
}
.footer__social {
    margin-bottom: 10px;
}
.footer__bottom {
    row-gap: 0;
    position: relative;
    padding-top: 6px;
    padding-bottom: 52px;
}
.footer__bottom-info {
    row-gap: 10px;
}
.footer__dev {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
    width: 100%;
    column-gap: 4;
    justify-content: space-between;
}
.footer__top {
    padding-top: 10px;
    padding-bottom: 14px;
}
.footer__info {
    padding-top: 10px;
    padding-bottom: 21px;
}
.footer__info span {
    font-size: 11px;
}
.footer__top-list,
.footer__top-nav ul {
    display: grid;
    row-gap: 10px;
    font-size: 12px;
}
.footer__top-list--wrap {
    padding-top: 10px;
}
.footer__top-nav {
    padding-top: 20px;
    grid-column: 1/2;
    grid-row: 3/4;
}
}
</style>
