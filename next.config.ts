import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: 'standalone',
  experimental: {
    // Enable standalone output for Docker
    outputFileTracingRoot: undefined,
  },
};

export default nextConfig;
