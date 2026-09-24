
    min-height: 100vh;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;
}

.auth-card {

    position: relative;

    width: 100%;
    max-width: 420px;

    padding: 40px 34px;

    border-radius: 22px;

    background:
        linear-gradient(
            135deg,
            rgba(20, 29, 45, 0.90),
            rgba(9, 14, 24, 0.88)
        );

    border: 1px solid rgba(255, 255, 255, 0.13);

    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);

    box-shadow:
        0 25px 70px rgba(0, 0, 0, 0.45),
        inset 0 1px 0 rgba(255, 255, 255, 0.08);

    animation: modalAppear 0.4s ease;

    text-align: center;
}

.auth-icon {

    width: 56px;
    height: 56px;

    margin: 0 auto 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 24px;

    border-radius: 16px;

    background:
        linear-gradient(
            135deg,
            #ffe08a,
            #d9a928
        );

    color: #17120a;

    box-shadow:
        0 8px 25px rgba(255, 193, 7, 0.25);
}

.auth-title {

    margin: 0 0 6px;

    font-size: 26px;
    font-weight: 600;

    color: #ffffff;
}

.auth-title span {
    color: #ffd36a;
}

.auth-subtitle {

    margin: 0 0 26px;

    font-size: 13px;

    color: #9ca6b7;
}

.auth-card form {
    text-align: left;
}

.auth-submit-btn {

    width: 100%;

    margin-top: 8px;

    text-align: center;
}

.auth-footer-text {

    margin: 22px 0 0;

    font-size: 13px;

    color: #9ca6b7;
}

.auth-footer-text a {

    color: #ffd36a;

    font-weight: 600;

    text-decoration: none;
}

.auth-footer-text a:hover {
    text-decoration: underline;
}

.auth-alert {

    margin-bottom: 18px;

    padding: 12px 14px;

    border-radius: 10px;

    font-size: 12.5px;

    text-align: left;

    background: rgba(220, 38, 70, 0.15);
    color: #ff7187;
    border: 1px solid rgba(255, 70, 100, 0.35);
}

.auth-alert-success {

    background: rgba(40, 180, 100, 0.15);
    color: #6fe0a3;
    border: 1px solid rgba(60, 200, 120, 0.35);
}

.user-box {

    display: flex;
    align-items: center;
    gap: 14px;

    margin-left: 16px;
}

.user-box-name {

    font-size: 12.5px;
    font-weight: 500;

    color: #d7dde8;

    white-space: nowrap;
}

.logout-btn {

    background:
        hsl(349, 100%, 51%) !important;

    color: rgb(255, 7, 7) !important;

    border: 1px solid rgba(255, 70, 100, 0.35) !important;

    border-radius: 9px !important;

    padding: 8px 16px !important;

    font-size: 12px;
    font-weight: 500;

    transition: all 0.25s ease;
}

.logout-btn:hover {

    background:
        linear-gradient(
            135deg,
            #d91f48,
            #a91334
        ) !important;

    color: #fff !important;

    border-color: #ff5275 !important;

    transform: translateY(-3px);

    box-shadow:
        0 7px 20px rgba(220, 38, 70, 0.30);
}

@media (max-width: 768px) {

    .auth-card {

        padding: 30px 22px;
    }

    .page-header {
        flex-wrap: wrap;
    }

    .user-box {

        margin-left: 0;

        width: 100%;

        justify-content: space-between;
    }
}