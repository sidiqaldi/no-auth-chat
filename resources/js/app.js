import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import VueChatScroll from 'vue3-chat-scroll';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import VueVirtualScroller from 'vue-virtual-scroller';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(ZiggyVue)
        .use(VueChatScroll)
        .use(VueVirtualScroller)
        .mount(el)
    },
})