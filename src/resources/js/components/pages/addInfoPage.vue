<template>
    <div class="div-add-list">
        <ul class="add-list row">
            <li class="col-xl-6 col-lg-12">
                <router-link :to="{ name: 'issues.create' }">
                    ВИПУСК
                </router-link>
            </li>
            <li class="col-xl-6 col-lg-12">
                <router-link :to="{ name: 'states.create' }">
                    СТАТТЯ
                </router-link>
            </li>
            <li class="col-xl-6 col-lg-12">
                <router-link :to="{ name: 'media.create' }">
                    ПАПКА
                </router-link>
            </li>
            <li class="col-xl-6 col-lg-12">
                <router-link :to="{ name: 'headings.create' }">
                    РУБРИКА
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "addInfoPage"
}
</script>

