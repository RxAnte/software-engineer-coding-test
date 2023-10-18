'use client';

import './globals.css';
import { QueryClientProvider } from '@tanstack/react-query';
import { QueryClient } from '@tanstack/query-core';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import { ReactNode } from 'react';
import Nav from './Nav';

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            refetchOnWindowFocus: false,
        },
    },
});

const RootLayout = ({ children }: { children: ReactNode }) => (
    <>
        <html lang="en">
            <body>
                <div>
                    <div className="max-w-2xl mx-auto">
                        <Nav />
                    </div>
                </div>
                <main>
                    <QueryClientProvider client={queryClient}>
                        {children}
                        <ReactQueryDevtools />
                    </QueryClientProvider>
                </main>
            </body>
        </html>
    </>
);

export default RootLayout;
