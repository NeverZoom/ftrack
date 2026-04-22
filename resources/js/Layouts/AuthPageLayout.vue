<script setup>
  import AuthorPlaceholder from "@/Components/Guest/AuthorPlaceholder.vue";
  import HomeHeader from "@/Components/Guest/HomeHeader.vue";
  import { Link } from "@inertiajs/vue3";
</script>
<template>

  <HomeHeader />
  <main>
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="header_wrapper">
              <h1><Link :href="route('home')">F.Track</Link></h1>
              <p>Небольшое приложения для учета финансов <br>и отслеживания статистики</p>
            </div>
          </div>
          <div class="col-12">
            <div class="content_wrapper">
              <slot />
            </div>
          </div>
          <div class="col-12">
            <AuthorPlaceholder/>
          </div>
        </div>
    </div>
  </main>
</template>

<style scoped lang="scss">
.header_wrapper{
  border-radius: 20px;
  width: 100%;
  background: $light-grey;
  padding: 37px 24px;
  margin-bottom: 10px;
  h1 {
    font-weight: 700;
    font-size: 40px;
    text-transform: uppercase;
    color: $dark-font;
    margin-bottom: 5px;
    a {
      color: $dark-font;
    }
  }
  p {
    margin-bottom: 0;
    font-weight: 400;
    font-size: 14px;
    line-height: 120%;
    color: rgba($dark-font, 0.7);
  }
}
.content_wrapper {
  border-radius: 20px;
  background: $dark;
  padding: 24px;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 600px;  
}
</style>