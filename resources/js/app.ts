import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import App from "./App.vue";

createInertiaApp({
    resolve: (name: string) => {
        const page = resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob("./pages/**/*.vue"),
        );

        page.then((module: any) => {
            module.default.layout ||= App;
        });

        return page;
    },
});
