import './globals.css';
import { ReactNode } from 'react';
import Nav from './Nav';

const RootLayout = ({
    children,
}: {
    children: ReactNode;
}) => (
    <>
        <html lang="en">
            <body>
                <div>
                    <div className="max-w-2xl mx-auto">
                        <Nav />
                    </div>
                </div>
                <div>
                    {children}
                </div>
            </body>
        </html>
    </>
);

export default RootLayout;
