<template>
    <div class="states state-show-div">
        <div>
            <p class="state-show-name">
                {{ this.showState.name }}
            </p>
            <div>
                <form :action="{name: 'rating.store', stateId: this.showState.id }"
                      id="addStar" method="POST" class="form-horizontal poststars">
                    <div class="required">
                        <div class="col-sm-12">
                            <div class="state-rating-div">
                                <p class="state-rating-p">
                                    Середня: {{ this.showState.rating }}
                                </p>
                                <p class="state-rating-p">
                                    Вже оцінили: {{ this.showState.ratingCount }}
                                </p>
                            </div>
                            <div>
                                <input class="star star-5" value="5" id="star-5" type="submit" name="star"/>
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" value="4" id="star-4" type="submit" name="star"/>
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" value="3" id="star-3" type="submit" name="star"/>
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" value="2" id="star-2" type="submit" name="star"/>
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" value="1" id="star-1" type="submit" name="star"/>
                                <label class="star star-1" for="star-1"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <img :src="/storage/ + this.showState.logo" class="d-block w-100">
            <p v-html="this.showState.body">
                {{ this.showState.body }}
            </p>
            <p class="state-show-author">
                {{ this.showState.author }}
            </p>
            @if(Auth::user() && Auth::user()->admin)
            <div class="state-show-redact-destroy">
                <div class="redact-state-link">
                    <router-link :to="{ name: 'states.edit', params: { state: this.showState.id } }">
                        Редагувати
                    </router-link>
                </div>
                <form :action="{ name:'state.destroy', params: { state: this.showState.id } }"
                      class="destroy-state"
                      method="post">
                    <button type="submit">
                        До архіва
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "StateShow",
    props: {
        showState: Object,
    }
}
</script>

<style scoped>

</style>
