<template>
    <div class="footer-page-container">
        <div class="footer-page-head">
            <h3>Anime Zero</h3>
            <p>/ Для правообладателей</p>
        </div>
        <h2 class="footer-page-title">
            Информация для правообладателей
        </h2>
        <p class="footer-page-subtitle">
            Деятельность сайта AnimeZero осуществляется в соответствии с законодательством РФ в области защиты
            информации и авторских прав на предоставляемый контент.
        </p>
        <div class="copyright-body">
            <p>
                Все размещенные на нашем ресурсе материалы находятся в свободном доступе и могут быть бесплатно скачаны
                из интернета. Сбор информации в сети и размещение контента производится в автоматическом режиме.
            </p>
            <p>
                Публикация нелицензионного, похищенного контента и материалов, защищенных авторским правом, не
                допускается. Администрация размещает только любительские русскоязычные материалы из свободных источников
                при использовании автоматической системы.
            </p>
            <p>
                Администрация ресурса предлагает сотрудничество с правообладателями контента. В случае нарушения прав
                собственности сайт обязуется убрать неправомерно размещенный материал или предложить выгодные условия
                сотрудничества правообладателю. Если вы обнаружили материал, представленный на нашем сайте, который
                нарушает ваши авторские права, или же дискредитирует Вашу компанию, предоставляя неверную или искаженную
                информацию, пожалуйста свяжитесь с нами для решения этого вопроса.
            </p>
            <p>
                Для этого вы можете обратиться в поддержку или отправить сообщение на нашу корпоративную почту
                <a href="mailto:admin@animezero.ru">admin@animezero.ru</a> со следующим содержанием:
            </p>
            <ul>
                <li>Контактные данные</li>
                <li>Реквизиты вашей компании</li>
                <li>Прямую ссылку (ссылки) на материал, который вы считаете спорным</li>
                <li>
                    Заверенные сканированные копии документов, подтверждающих ваше эксклюзивное право на материал (или
                    копии документов на посреднические услуги)
                </li>
            </ul>
            <p>
                После проверки всей информации, администрация сайта свяжется с вами для урегулирования спорного
                вопроса.
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CopyrightPage'
};
</script>

<style scoped>
.copyright-head {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-top: 100px;
    margin-bottom: 26px;
}

.copyright-head h3 {
    font-weight: 700;
    font-size: 19px;
    border-bottom: 2px solid var(--main-color);
    margin-right: 5px;
}

.copyright-head p {
    color: #808080;
    font-weight: 500;
    font-size: 16px;
}

.copyright-title {
    font-weight: 500;
    font-size: 32px;
    margin-bottom: 20px;
}

.copyright-subtitle {
    font-weight: 500;
    font-size: 16px;
    color: #7F7F7F;
    margin-bottom: 20px;
}

.copyright-body p {
    margin-bottom: 10px;
}

.copyright-body ul {
    list-style-type: disc;
    max-width: none;
    margin: 10px 0 10px 40px;
}

.copyright-body li {
    margin: 0;
}

.copyright-body a {
    color: var(--main-color);
    text-decoration: none;
    font-weight: 600;
}

</style>
