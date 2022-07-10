<template>
    <div>
        <header>
            <app-header></app-header>
        </header>
        <main
            class="relative col-11 flex items-top justify-center min-h-slogo.tifcreen dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="row">
                <section>
                    <router-view></router-view>
                </section>
            </div>
        </main>
    </div>
</template>

<script>
import AppHeader from "./components/AppHeader";

export default {
    name: "App",
    components: {
        AppHeader
    },
}
</script>
