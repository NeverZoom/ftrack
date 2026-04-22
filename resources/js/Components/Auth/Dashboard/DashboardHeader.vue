<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
  <header class="blured">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-6 d-flex align-items-center">
          <div class="user-hello">Доброе утро, <br> <b>{{ $page.props.auth.user.name }}</b>!</div>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <Link :href="route('profile.edit')" class="profile">
            <img src="/user.png" alt="" class="user-avatar">
          </Link>
        </div>
        <div class="col-12 balance-info">
          <span>Текущий баланс</span>
          <h2>1 000 000,40 ₽</h2>
        </div>
        <div class="col-12">
          <div class="stats_wrapper">
            <div class="balance-stats">
              <div class="arrow">
                <template v-if="$page.props.lastIncome == 0">
                  <svg width="225" height="225" viewBox="0 0 225 225" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.5594 2.10034C27.3594 3.20034 29.6594 5.60034 30.8594 7.40034C32.8594 10.7003 32.8594 12.0004 32.8594 89.6004V168.5L111.059 90.3004C196.259 5.30035 192.159 8.90034 201.659 10.6003C206.659 11.5003 213.359 18.2004 214.259 23.2004C215.959 32.7004 219.559 28.6004 134.559 113.7L56.3594 192H135.259C213.059 192 214.159 192 217.459 194.1C222.459 197.1 224.859 201.8 224.859 208.2C224.859 214.7 222.259 219.3 216.859 222.4C213.359 224.5 212.159 224.5 115.059 224.8C45.4594 225 15.5594 224.7 12.5594 223.9C7.35937 222.5 2.35937 217.5 0.959372 212.3C0.159372 209.3 -0.140628 179.4 0.0593717 109.8C0.359372 12.7004 0.359372 11.5003 2.45937 8.00034C5.65937 2.50034 10.1594 0.000338446 16.7594 0.000338446C20.6594 0.000338446 23.3594 0.600338 25.5594 2.10034Z" fill="black"/>
                  </svg>
                </template>
                <template v-else-if="$page.props.lastIncome == 1">
                  <svg width="225" height="225" viewBox="0 0 225 225" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M199.3 222.76C197.5 221.66 195.2 219.26 194 217.46C192 214.16 192 212.86 192 135.26V56.36L113.8 134.56C28.6 219.56 32.7 215.96 23.2 214.26C18.2 213.36 11.5 206.66 10.6 201.66C8.9 192.16 5.3 196.26 90.3 111.16L168.5 32.86H89.6C11.8 32.86 10.7 32.86 7.4 30.76C2.4 27.76 0 23.06 0 16.66C0 10.16 2.6 5.56 8 2.46C11.5 0.36 12.7 0.36 109.8 0.06C179.4 -0.14 209.3 0.16 212.3 0.96C217.5 2.36 222.5 7.36 223.9 12.56C224.7 15.56 225 45.46 224.8 115.06C224.5 212.16 224.5 213.36 222.4 216.86C219.2 222.36 214.7 224.86 208.1 224.86C204.2 224.86 201.5 224.26 199.3 222.76Z" fill="black"/>
                  </svg>
                </template>
              </div>
              <div class="content">
                <span>Доходы</span>
                <b>{{ $page.props.allIncome.toLocaleString("ru-RU") }} ₽</b>
              </div>
            </div>
            <div class="balance-stats">
              <div class="arrow">
                <template v-if="$page.props.lastExpence == 0">
                  <svg width="225" height="225" viewBox="0 0 225 225" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25.5594 2.10034C27.3594 3.20034 29.6594 5.60034 30.8594 7.40034C32.8594 10.7003 32.8594 12.0004 32.8594 89.6004V168.5L111.059 90.3004C196.259 5.30035 192.159 8.90034 201.659 10.6003C206.659 11.5003 213.359 18.2004 214.259 23.2004C215.959 32.7004 219.559 28.6004 134.559 113.7L56.3594 192H135.259C213.059 192 214.159 192 217.459 194.1C222.459 197.1 224.859 201.8 224.859 208.2C224.859 214.7 222.259 219.3 216.859 222.4C213.359 224.5 212.159 224.5 115.059 224.8C45.4594 225 15.5594 224.7 12.5594 223.9C7.35937 222.5 2.35937 217.5 0.959372 212.3C0.159372 209.3 -0.140628 179.4 0.0593717 109.8C0.359372 12.7004 0.359372 11.5003 2.45937 8.00034C5.65937 2.50034 10.1594 0.000338446 16.7594 0.000338446C20.6594 0.000338446 23.3594 0.600338 25.5594 2.10034Z" fill="black"/>
                  </svg>
                </template>
                <template v-else-if="$page.props.lastExpence == 1">
                  <svg width="225" height="225" viewBox="0 0 225 225" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M199.3 222.76C197.5 221.66 195.2 219.26 194 217.46C192 214.16 192 212.86 192 135.26V56.36L113.8 134.56C28.6 219.56 32.7 215.96 23.2 214.26C18.2 213.36 11.5 206.66 10.6 201.66C8.9 192.16 5.3 196.26 90.3 111.16L168.5 32.86H89.6C11.8 32.86 10.7 32.86 7.4 30.76C2.4 27.76 0 23.06 0 16.66C0 10.16 2.6 5.56 8 2.46C11.5 0.36 12.7 0.36 109.8 0.06C179.4 -0.14 209.3 0.16 212.3 0.96C217.5 2.36 222.5 7.36 223.9 12.56C224.7 15.56 225 45.46 224.8 115.06C224.5 212.16 224.5 213.36 222.4 216.86C219.2 222.36 214.7 224.86 208.1 224.86C204.2 224.86 201.5 224.26 199.3 222.76Z" fill="black"/>
                  </svg>
                </template>
              </div>
              <div class="content">
                <span>Расходы</span>
                <b>{{ $page.props.allExpence.toLocaleString("ru-RU") }} ₽</b>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<style lang="scss" scoped>
header {
  background: $dark;
  color: $light-font;
  padding: 25px 0 20px 0;
  border-radius: 0 0 20px 20px;
  .user-hello {
    font-weight: 400;
    font-size: 20px;
    line-height: 120%;
    b {
      font-weight: 700;
    }
  }
  .profile {
    img {
      width: 60px;
      height: 60px;
      object-fit: cover;
    }
  }
  .balance-info {
    margin: 30px 0 35px 0;
    span {
      font-weight: 400;
      font-size: 20px;
      line-height: 120%;
      color: rgba($light-font, 0.8);
    }
    h2 {
      font-weight: 700;
      font-size: 40px;
      line-height: 120%;
    }
  }
  .stats_wrapper {
    border-radius: 16px;
    background: $bg;
    @include flex-center;
    gap: 30px;
    padding: 14px 24px;
    .balance-stats {
      @include flex-center;
      gap: 8px;
      .content {
        display: flex;
        flex-direction: column;
        span {
          font-weight: 400;
          font-size: 14px;
          line-height: 120%;
          color: rgba($dark-font, 0.8);
        }
        b {
          font-weight: 700;
          font-size: 18px;
          line-height: 120%;
          color: $dark;
        }
      }
      .arrow {
        border: 1px solid $grey;
        border-radius: 100px;
        width: 60px;
        height: 60px;
        @include flex-center;
        svg {
          width: 12px;
          height: 12px;
        }
      }
    }
  }
}

</style>