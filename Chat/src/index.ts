const world = 'world';

// @ts-ignore
export function hello(world: string = world): string {
    return `Hello ${world}! `;
}
