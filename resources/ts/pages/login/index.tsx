import React, { useState } from "react";
import { useLogin } from "../../queries/AuthQuery";

const LoginPage: React.FC = () => {
    const login = useLogin();
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const handleLogin = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        login.mutate({ email, password });
    };
    const handleGest = () => {
        setEmail("gest@gest.com");
        setPassword("123456789");
    };

    return (
        <>
            <div className="login-page">
                <div className="login-panel">
                    <form onSubmit={handleLogin}>
                        <div className="input-group">
                            <label>メールアドレス</label>
                            <input
                                type="email"
                                className="input"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                            />
                        </div>
                        <div className="input-group">
                            <label>パスワード</label>
                            <input
                                type="password"
                                className="input"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                            />
                        </div>
                        <div className="gest">
                            <label>
                                <input
                                    type="checkbox"
                                    id="gestMode"
                                    title="ゲストモードでログインする"
                                    onClick={() => handleGest()}
                                />
                                <span>ゲストモードでログインする</span>
                            </label>
                        </div>
                        <button type="submit" className="btn">
                            ログイン
                        </button>
                    </form>
                </div>
                <div className="links">
                    <a href="#">ヘルプ</a>
                </div>
            </div>
        </>
    );
};

export default LoginPage;
