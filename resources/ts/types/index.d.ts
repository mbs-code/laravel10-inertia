import { User } from '@/types/model'

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  auth: {
    user: User
  }
  flash: {
    message?: string
  }
  app: {
    name: string
    env: string
    debug: boolean
  }
}
