<template>
    <div class="col-lg-7 col-md-12 mt-4">

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" class="active" aria-current="true"
                        data-bs-slide-to="0" aria-label="Slide 1">
                </button>
                <button type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="1" aria-label="Slide 2">
                </button>
                <button type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="2" aria-label="Slide 3">
                </button>
                <button type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="3" aria-label="Slide 4">
                </button>
                <button type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="4" aria-label="Slide 5">
                </button>
            </div>

            <div class="carousel-inner">
                <div :class=" index === 0 ? 'active' : '' " class="carousel-item" :key="index"
                     v-for="(state, index) in this.states">
                    <img :src="`storage/${state.logo}`" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>
                            <router-link :to="{ name: 'states.show', params: {state: state.id} }"
                                         class="slider-link">
                                {{ state.name }}
                            </router-link>
                        </p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Carousel",
    props: {
        states: Array,
    },
}
</script>

<style scoped>

</style>
