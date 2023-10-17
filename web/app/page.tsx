import type { Metadata } from 'next';

export const metadata: Metadata = {
    other: {
        foo: 'bar',
    },
};

const HomePage = () => (
    <main>
        Hello World!
    </main>
);

export default HomePage;
