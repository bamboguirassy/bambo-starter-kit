import './bootstrap';
import { createApp } from 'vue';
import { default as Exemple } from './components/exemple/index.vue';
import { ConfigProvider, Switch, Spin, Statistic, Card, Empty, AutoComplete } from 'ant-design-vue';
import 'dayjs/locale/fr';
import frFR from 'ant-design-vue/es/locale/fr_FR';
import SearchBar from './components/header/SearchBar/index.vue';

const app = createApp({
    data() {
        return {
            locale: frFR
        }
    }
});

app.config.globalProperties.dynamicColors = function () {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
  }

app.use(Switch);
app.use(ConfigProvider);
app.use(Spin);
app.use(Statistic);
app.use(Card);
app.use(Empty);

app.component('exemple', Exemple);
app.mount('#main');


const headerApp = createApp({
    data() {
        return {
            locale: frFR
        }
    }
});

headerApp.use(AutoComplete);

headerApp.component('search-bar', SearchBar);
headerApp.mount('#header');
