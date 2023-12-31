// @ts-check

/**
 * @type {import('next').NextConfig}
 */
module.exports = {
    publicRuntimeConfig: {
    },
    serverRuntimeConfig: {
    },
    eslint: {
        ignoreDuringBuilds: true,
    },
    poweredByHeader: false,
    reactStrictMode: true,
    async redirects() {
        return [
            {
                source: '/',
                destination: '/todos',
                permanent: false,
            }
        ];
    }
};
